<?php
require __DIR__ . '/vendor/autoload.php';

use Swoole\Table;
use Swoole\Http\Request;
use Swoole\WebSocket\Server;
use Swoole\WebSocket\Frame;

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

$auth = array(
    'VAPID' => array(
        'subject' => 'https://github.com/Minishlink/web-push-php-example/',
        'publicKey' => file_get_contents(__DIR__ . '/keys/public_key.txt'), // don't forget that your public key also lives in app.js
        'privateKey' => file_get_contents(__DIR__ . '/keys/private_key.txt'), // in the real world, this would be in a secret file
    ),
);

$webPush = new WebPush($auth);

$active_clients = new Table(1024);;
$active_clients->column('fd', Table::TYPE_INT);
$active_clients->create();

$subscription = new Table(1024);;
$subscription->column('fd', Table::TYPE_INT);
$subscription->column('subscription', Table::TYPE_STRING, 2048);
$subscription->column('state', Table::TYPE_STRING, 32);
$subscription->create();

if (1) {
    $ssl_dir = "/usr/local/lsws/conf/cert";
    $server = new Server("0.0.0.0", 9505, SWOOLE_BASE, SWOOLE_SOCK_TCP | SWOOLE_SSL);
    $server->set([
        'ssl_cert_file' => $ssl_dir . '/feedbackcloud.crt',
        'ssl_key_file' => $ssl_dir . '/feedbackcloud.key',
    ]);
} else {
    $server = new Server("0.0.0.0", 9505);
}
$server->active_clients = $active_clients;
$server->subscription = $subscription;
$server->webPush = $webPush;

$server->on("start", function (Server $server) {
    echo "Swoole WebSocket Server is started at http://127.0.0.1:9505\n";
});

$server->on('open', function (Server $server, Request $request) {
//TODO:  Проверть на наличие повтора в fd!
    $server->active_clients->set($request->fd, ['fd' => $request->fd]);
    $count = count($server->active_clients);
    echo "connection open: {$request->fd} of {$count}\n";
});

$server->on('message', function (Server $server, Frame $frame) {

    $json = json_decode($frame->data, true);

    if (is_null($json))
        return;

    if (isset($json["message"])) {
        echo "received message: {$frame->data} from {$frame->fd}\n";
        $message = json_encode($json);
        foreach ($server->active_clients as $connection) {
            $fd = $connection["fd"];
            echo "push message: to {$fd}\n";
            $server->push($fd, $message);
        }

        foreach ($server->subscription as $s)
            if (in_array($s["state"], ["offline", "blur"])) {
                $webPush = $server->webPush;
                $subscription = Subscription::create(json_decode($s["subscription"], true));
                $res = $webPush->sendNotification(
                    $subscription,
                    $message
                );

                foreach ($webPush->flush() as $report) {
                    $endpoint = $report->getRequest()->getUri()->__toString();

                    if ($report->isSuccess()) {
                        echo "[v] Message sent successfully for subscription {$endpoint}.";
                    } else {
                        echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
                    }
                }
            }
    } elseif (isset($json["endpoint"])) {
        $client_id = hash("md5", $json["endpoint"]);

        $state = "?";

        if (isset($json["state"])) {
            if (!$server->subscription->exist($client_id)) {
                $s = ["subscription" => $frame->data, "fd" => $frame->fd, "state" => $json["state"]];
                $server->subscription[$client_id] = $s;
                $state = "new client! State: " . $s["state"];
            } else {
                $server->subscription[$client_id]["state"] = $json["state"];
                $state = "state: " . $json["state"];
            }
        }

        $server->push($frame->fd, json_encode([
            "state" => $server->subscription[$client_id]["state"]
        ]));

        echo "$client_id: $state\n";
    }
});

$server->on('close', function (Server $server, int $fd) {
    $server->active_clients->del($fd);
    $count = count($server->active_clients);
    echo "connection close: {$fd} of {$count}\n";

    foreach ($server->subscription as $client => $s) {
        if ($s["fd"] == $fd) {
            echo "client $client now offline\n";
            $server->subscription[$client]["state"] = $server->subscription[$client]["state"] != "disabled" ? "offline" : "disabled";
        }
    }
});

$server->start();

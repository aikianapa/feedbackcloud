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


$server = new Server("0.0.0.0", 9505);
$server->active_clients = $active_clients;
$server->subscription = $subscription;
$server->webPush = $webPush;

$server->on("start", function (Server $server) {
    echo "Swoole WebSocket Server is started at http://127.0.0.1:9502\n";
});

$server->on('open', function (Server $server, Request $request) {
    $server->active_clients->set($request->fd, ['fd' => $request->fd]);
    $count = count($server->active_clients);
    echo "connection open: {$request->fd} of {$count}\n";
});

$server->on('message', function (Server $server, Frame $frame) {
    echo "received message: {$frame->data} from {$frame->fd}\n";

    $json = json_decode($frame->data, true);

    if (is_null($json))
        return;

    var_dump($json);

    if (isset($json["message"])) {
        $message = $json["message"];
        foreach ($server->active_clients as $connection) {
            $fd = $connection["fd"];
            echo "push message: to {$fd}\n";
            $server->push($fd, $message);
        }

        foreach ($server->subscription as $s) {
            if ($s["fd"] < 0) {
                //TODO: Отправить уведомление о новом сообщении
                $subscription = Subscription::create($s);
                $res = $server->webPush->sendNotification(
                    $subscription,
                    $message
                );
            }
        }
    } elseif (isset($json["endpoint"])) {
        $client_id = $frame->fd;
        $server->subscription[$client_id] = $frame->data;

        var_dump(json_decode($server->subscription[$client_id]));
    } // TODO: Отзыв разрешения
});

$server->on('close', function (Server $server, int $fd) {
    $server->active_clients->del($fd);
    $count = count($server->active_clients);
    echo "connection close: {$fd} of {$count}\n";

    foreach ($server->subscription as $client => $s)
        if ($s["fd"] == $fd)
            $server->subscription[$client]["fd"] = -1;
});

$server->start();

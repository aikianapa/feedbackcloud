<?php
use Swoole\Table;
use Swoole\Http\Request;
use Swoole\WebSocket\Server;
use Swoole\WebSocket\Frame;
require "./engine/engine.php";

$table = new Table(1024);;
$table->column('fd', Table::TYPE_INT);
$table->create();

$ssl_dir = "/usr/local/lsws/conf/cert";

$server = new Server("0.0.0.0", 9502, SWOOLE_BASE, SWOOLE_SOCK_TCP | SWOOLE_SSL);
$server->set([
	'ssl_cert_file' => $ssl_dir . '/feedbackcloud.crt',
	'ssl_key_file' => $ssl_dir . '/feedbackcloud.key',
]);

$server->table = $table;

$server->on("start", function (Server $server) {
    echo "Swoole WebSocket Server is started at https://127.0.0.1:9502\n";
});

$server->on('open', function (Server $server, Request $request) {
    $server->table->set($request->fd, ['fd'=>$request->fd]);
    $count = count($server->table);
    echo "connection open: {$request->fd} of {$count}\n";
});

$server->on('message', function (Server $server, Frame $frame) {
    //echo "received message: {$frame->data} from {$frame->fd}\n";
    $data = $frame->data;
    foreach ($server->table as $connection) {
        $fd = $connection["fd"];
        $data = json_decode($data,true);
        $data["data"]["text"] = htmlentities($data["data"]["text"]);
        $data = json_encode($data);
        $server->push($fd, $data);
    }
//    file_put_contents(__DIR__ . '/log.txt', json_encode($frame->data) . PHP_EOL, FILE_APPEND);
	$uri = "/ajax/chat/msg/";
    chatQuery($uri, $frame->data);
});

$server->on('close', function (Server $server, int $fd) {
    $server->table->del($fd);
    $count = count($server->table);
    echo "connection close: {$fd} of {$count}\n";
});

$server->start();

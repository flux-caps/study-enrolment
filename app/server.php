<?php
require_once __DIR__."/../vendor/autoload.php";
use FluxEco\EcoExample;
$applicationApi =  EcoExample\Api::new();

$server = new Swoole\HTTP\Server("0.0.0.0", 9510);
$server->set([
    'document_root' => '/app/public',
    'enable_static_handler' => true,
    'dispatch_mode' => 2,
    'task_worker_num' => 1,
    'worker_num' => 1
]);
$server->on("start", function (Swoole\Http\Server $server) use($applicationApi) {
    echo "Swoole http server is started at http://127.0.0.1:9510\n";
    $applicationApi->swooleHttpServerHasStarted();
});

$server->on("request", function (Swoole\Http\Request $request, Swoole\Http\Response $response) {

    switch($channel) {
        case "getPageData":

            break;
    }


    $response->header("Content-Type", "text/plain");
    $response->end("Hello World\n");
});

$server->on("receive", function(Swoole\Server $server, int $fd, int $reactorId, string $data)
{
    $server->send($fd, "Echo to #{$fd}: \n".$data);
    $server->close($fd);
});

$server->on('Shutdown', function ($serv) {
    echo 'Shutdown' . PHP_EOL;
});

$server->on('WorkerError', function (Swoole\Server $server, int $workerId, int $workerPid, int $exitCode, int $signal)  {

});

$server->on('Task', function (Swoole\Server $server, $task_id, $reactorId, $data) {

});


$server->start();
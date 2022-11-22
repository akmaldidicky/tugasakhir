<?php
require "database.php";

//$db= new database();

$client = new Mosquitto\Client();
$client->onConnect('connect');
$client->onDisconnect('disconnect');
$client->onSubscribe('subscribe');
$client->onMessage('message');
$client->connect("localhost", 1883, 60);
$client->onLog('logger');
$client->subscribe('#', 1);

while (true) {
    $client->loopForever();
    sleep(1);
}
$client->disconnect();
unset($client);
function connect($r)
{
    echo "I got code {$r}\n";
}

function subscribe()
{
    echo "Subscribed to a topic\n";
}

function unsubscribe()
{
    echo "Unsubscribed from a topic\n";
}

function message($message)
{
    printf("Got a message on topic %s with payload:\n%s\n", $message->topic, $message->payload);
    //$data= $message->payload;

    $hasil = json_decode($message->payload, TRUE);
    // print_r ($hasil);
    $data = [];
    if ($message->topic == "mgdm/test") {
        $hasil = json_decode($message->payload, TRUE);
        $data = [];

        foreach ($hasil as $item) {
            foreach ($item['code'] as $indexCode => $code) {
                $data[] = [
                    'chip_id' => $item['chip_id'],
                    'key_device' => $item['key_device'],
                    'nama_header' => $item['nama_header'],
                    'code_header' => $code,
                    'data' => $item['nilai'][$indexCode],
                    'time_add' => date('Y-m-d H:i:s'),
                ];
            }
        }
        $db = new database();
        $db->insert_data($data);
    }
}

function disconnect()
{
    echo "Disconnected cleanly\n";
}
function logger()
{
    var_dump(func_get_args());
}

<?php

$client = new Mosquitto\Client();
$client->onConnect('connect');
$client->onDisconnect('disconnect');
$client->onSubscribe('subscribe');
$client->onMessage('message');
$client->connect("localhost", 1883, 5);
$client->subscribe('#', 1);
for ($i = 0; $i < 10; $i++) {
    $client->loop();
}
$client->unsubscribe('/#');
for ($i = 0; $i < 10; $i++) {
    $client->loop();
}
function connect($r, $message)
{
    echo "I got code {$r} and message {$message}\n";
}
function subscribe()
{
    echo "Subscribed to a topic\n";
}


function message($message)
{
    printf("Got a message on topic %s with payload:\n%s\n", $message->topic, $message->payload);
    $servername = "localhost";
    $username = "mestakung";
    $password = "dbmesta2022";
    $dbname = "mesta";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($message->topic == "mgdm/test") {
        $sql = "INSERT INTO percobaan (nilai)
VALUES ($message->payload)";
    }
    if ($conn->multi_query($sql) === TRUE) {
        echo "New record created successfully\n";
    }
    $conn->close(); {
    }
}
function disconnect()
{
    echo "Disconnected cleanly\n";
}

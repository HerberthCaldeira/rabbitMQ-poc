<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'user', 'password');
$channel = $connection->channel();

$channel->queue_declare('q1', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function (AMQPMessage $msg) {
	echo ' [x] Received ', $msg->getBody(), "\n";
};

$channel->basic_consume('q1', '', false, true, false, false, $callback);

try {
	$channel->consume();
} catch (\Throwable $exception) {
	echo $exception->getMessage();
}

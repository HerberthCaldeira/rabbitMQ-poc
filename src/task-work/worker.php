<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'user', 'password');
$channel = $connection->channel();

$channel->queue_declare('queue_task', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function (AMQPMessage $msg) {
	echo ' [x] Received ', $msg->getBody(), "\n";
	sleep($msg->getBody());
	$msg->ack();
	echo ' [x] Done', "\n";
};

$channel->basic_consume('queue_task', '', false, false, false, false, $callback);

try {
	$channel->consume();
} catch (\Throwable $exception) {
	echo $exception->getMessage();
}

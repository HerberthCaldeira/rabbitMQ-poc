<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'user', 'password');
$channel = $connection->channel();

$channel->exchange_declare('logs', 'fanout', false, false, false);

list($queue_name,,) = $channel->queue_declare("", false, false, true, false);

$channel->queue_bind($queue_name, 'logs');

echo " [*] Waiting for logs. To exit press CTRL+C\n";

$callback = function (AMQPMessage $msg) {
	echo ' [x] ', $msg->getBody(), "\n";
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

try {
	$channel->consume();
} catch (\Throwable $exception) {
	echo $exception->getMessage();
}

$channel->close();
$connection->close();

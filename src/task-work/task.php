
<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

echo "\n";
echo "argsv";
print_r($argv);

#how long the task will take to be completed
$timeJob = $argv[1];
if (! is_numeric($timeJob)) {
	echo 'task need time in seconds';
	exit;
}

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'user', 'password');
$channel = $connection->channel();

$channel->queue_declare('queue_task', false, false, false, false);

$msg = new AMQPMessage($timeJob);

$channel->basic_publish($msg, '', 'queue_task');

$channel->close();
$connection->close();

echo " [x] Sent task! size in seconds: $timeJob\n";

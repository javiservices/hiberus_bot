<?php
// include_once('conf.php');

spl_autoload_register(function($class) {
	include_once 'classes/' . $class . '.php';
});

$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chat_id = $update["message"]["chat"]["id"] ? $update["message"]["chat"]["id"] : -515516274;
$message = $update["message"]["text"];

// Available bot commands
$commands = [
	// General Commands
	'help',

	// Server Commands
	'server',

	//Alias for /server uptime
	'uptime',
	
	// Alias for /server uname
	'uname',

	// Alias for /server who
	'who',

	// Alias for /server disk
	'disk',

];

$arguments = [
	// Server
	'server'=>[
		'uptime',
		'uname',
		'who',
		'disk',
	],
	'help'=>[
		'server',
	],
];

// Aliases for commands
$alias = [
	'uptime'=>'server',
	'uname'=>'server',
	'who'=>'server',
	'disk'=>'server',
];

$args = explode(' ', trim($message));

$command = ltrim($args[0], '/');
$method = '';
if (isset($args[0]) && in_array($args[0], $arguments[$command])) {
	$method = array_shift($args);
}
else { 
	if (in_array($command, array_keys($alias))) {
		$method = $command;
		$command = $alias[$command];
	}
}


switch ($command) {
	case 'server':
		$class = 'Server';
		break;
	case 'help':
		$class = 'Help';
		break;
	default:
		$class = 'Bot';
}

$hook = new $class($conf, $chat_id);

if (!$hook->isTrusted()) {
	$hook->unauthorized();
	die();
}
if (date('H:i') == '03:40') {
	$hook->send('aaaaa');

}
if (preg_grep('/jajaja/',$args)) {

	$gracioso = [
		'jajajaja que gracioso',
		'LOOOOL',
		'E-PI-CO, que grande',
	];
	$hook->send($gracioso[rand(0, count($gracioso))]);
}

// if (!in_array($command, $commands)) {
// 	$hook->unknown();
// }

// else {
// 	if (isset($arguments[$command]) && in_array($method, $arguments[$command])) {
// 		$hook->{$method}($args);
// 		die();
// 	} else if (in_array($command, $commands)) {
// 		$hook->{$command}($args);
// 	} else {
// 		$hook->unknown();
// 	}
// }
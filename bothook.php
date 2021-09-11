<?php
include_once('conf.php');
include_once('functions/chiste.php');
spl_autoload_register(function($class) {
	include_once 'classes/' . $class . '.php';
});

$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chat_id = $update["message"]["chat"]["id"] ? $update["message"]["chat"]["id"] : -515516274;
$message = $update["message"]["text"];


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

$hook = new Bot($conf, $chat_id);

if (!$hook->isTrusted()) {
	$hook->unauthorized();
	die();
}
if (preg_grep('/jajaja/',$args)) {

	$gracioso = [
		'jajajaja que gracioso',
		'LOOOOL',
		'E-PI-CO, que grande',
	];
	$hook->send($gracioso[rand(0, count($gracioso))]);
}
if (preg_grep('/chiste/',$args)) {
	$hook->send('Que quieres un chiste? Alla va uno!');
	
	$hook->send(generateChiste());
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
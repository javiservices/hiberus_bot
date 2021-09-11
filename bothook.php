<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conf = [
	//Change to your bot token, check the readme to know how to create and get your bot token.
	'bot_token' => '1973959366:AAGOQkHsugsjnSXYiOW_MW227gQDQ53rgto',
	//Set to TRUE if you want the bot only to awnser the trusted ChatIDs
	'only_trusted' => TRUE,
	//Populate the array with the trusted Chat IDs
	'trusted' => [ 
		-562492710,
		-515516274
	],
];
include_once('functions/chiste.php');

spl_autoload_register(function($class) {
	include_once 'classes/' . $class . '.php';
});

$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chat_id = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

$args = explode(' ', trim($message));

$bot = new Bot($conf, $chat_id);

if (!$bot->isTrusted()) {
	$bot->unauthorized();
	die();
}
if (preg_grep('/jajaja/',$args)) {

	$gracioso = [
		'jajajaja que gracioso',
		'LOOOOL',
		'E-PI-CO, que grande',
	];
	$bot->send($gracioso[rand(0, count($gracioso))]);
}
if (preg_grep('/chiste/',$args)) {
	$bot->send('Que quieres un chiste? Alla va uno!');
	
	$bot->send(generateChiste());
}

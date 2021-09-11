<?php
file_get_contents('https://api.telegram.org/bot1973959366:AAGOQkHsugsjnSXYiOW_MW227gQDQ53rgto/sendmessage?parse_mode=html&chat_id=-562492710&text=pruebacron');

include_once 'functions/chiste.php';
$time = date('H:i');
$dayOfWeek = date('w'); // 0 es domingo 6 es sabado

$arrDayOfWeekES = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];

if ($dayOfWeek >= 1 && $dayOfWeek <= 5) { // Si es entre semana
    if ($time == '07:30') {
        $arrGoodMorning = [
            'Buenos dias mi gente! Hoy es' . strtolower($arrDayOfWeekES[$dayOfWeek]) . ', son las 7 y media de la mañana y vamos a dale fuerte al dia!',
            'Hoy es vuestro dia adictos al café! Suerte con el '.strtolower($arrDayOfWeekES[$dayOfWeek]). '!'
        ];
        sendMessage($arrGoodMorning[rand(0, count($arrGoodMorning))]);
    }

} else { // Si es fin de semana
    $rand = random_int(0, 1000);
    if ($rand > 50 && $rand < 75) {
        sendMessage(generateChiste());
    }
}

function sendMessage($message) {
    $text = urlencode($message);
    file_get_contents('https://api.telegram.org/bot1973959366:AAGOQkHsugsjnSXYiOW_MW227gQDQ53rgto/sendmessage?parse_mode=html&chat_id=-562492710&text='.$text);
}
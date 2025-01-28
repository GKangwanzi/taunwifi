<?php 

function SendSMS($message_type,$message_category,$number,$message) { 

$username = '0785407551';
$password = 'GHARTZ14';
$sender = 'TaunWiFi';
$url = "www.sms.thepandoranetworks.com/API/send_sms/?";

$parameters="number=[number]&message=[message]&username=[username]&password=[password]&sender=[sender]&message_type=[message_type]&message_category=[message_category]";

$parameters = str_replace("[message]", urlencode($message), $parameters);
$parameters = str_replace("[sender]", urlencode($sender),$parameters);
$parameters = str_replace("[number]", urlencode($number),$parameters);
$parameters = str_replace("[username]", urlencode($username),$parameters);
$parameters = str_replace("[password]", urlencode($password),$parameters);
$parameters = str_replace("[message_type]", urlencode($message_type),$parameters);
$parameters = str_replace("[message_category]", urlencode($message_category),$parameters);

$live_url="https://".$url.$parameters;

$parse_url=file($live_url);

 $response = $parse_url[0];

return json_decode($response, true);

}

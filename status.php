<?php
include "includes/dbhandle.php";
include "includes/sms.php";

$client_id = "pay-d1b52074-078d-454f-8919-5358cc4c951b";
$client_secret = "IO-uJSnPjbYN9BaOUJQB2UukDj3wKOSpU2ap";
$auth_url = "https://id.iotec.io/connect/token";
$status_url = "https://pay.iotec.io/api/collections/status/";

// Step 1: Get access token
$data = http_build_query([
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'grant_type' => 'client_credentials'
]);
 
$options = [
    'http' => [
        'header'  => "Content-Type: application/x-www-form-urlencoded",
        'method'  => 'POST',
        'content' => $data
    ]
];

$context  = stream_context_create($options);
$response = file_get_contents($auth_url, false, $context);
if ($response === FALSE) {
    die("Failed to authenticate.");
}

$token = json_decode($response, true)['access_token'];
$package = $_GET['package'];
$phone = $_GET['phone'];
// Step 2: Check payment status
$sql    = "SELECT * FROM voucher WHERE status = 'available' AND package= '$package' ORDER BY voucherID DESC LIMIT 1 ";
$result = mysqli_query($con, $sql);
$row    = mysqli_fetch_array($result, MYSQLI_ASSOC);



$transaction_id = $_GET['id'];
$dns = $_GET['dns'];

$code  = $row["voucherID"];
$options = [
    'http' => [
        'header'  => "Authorization: Bearer $token\r\n",
        'method'  => 'GET'
    ]
];

$context  = stream_context_create($options);
$response = file_get_contents($status_url . $transaction_id, false, $context);

if ($response === FALSE) {
    die("Failed to check transaction status.");
}

$status = json_decode($response, true)['status'];

// Step 3: Update transaction in database
$sql = "UPDATE transactions SET status = ? WHERE transactionID = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $status, $transaction_id);
$stmt->execute();

$vstatus = 'sold';
$sql = "UPDATE voucher SET status = ? WHERE voucherID = ?";
$stmt2 = $con->prepare($sql);
$stmt2 -> bind_param("ss", $vstatus, $code);
$stmt2 -> execute();

$message = "Click the link to connect to TaunWiFi http://".$dns."/login.html?card=".$code;

// Step 4: Redirect based on status
if ($status === "Success") {
    SendSMS('non_customised','bulk', $phone, $message);
    header("Location: http://".$dns."/login.html?card=".$code." ");
} else {
    header("Location: failure.php");
}
exit;
?>
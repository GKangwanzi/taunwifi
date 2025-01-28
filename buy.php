
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>TaunWiFi</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<!-- ================== BEGIN core-css ================== -->
<link href="assets/css/vendor.min.css" rel="stylesheet">
<link href="assets/css/app.min.css" rel="stylesheet">
<!-- ================== END core-css ================== -->

</head>
<body>



<!-- BEGIN #app -->
<div id="app" class="app app-full-height app-without-header">
<!-- BEGIN login -->
<div class="login">
<!-- BEGIN login-content -->
<div class="login-content">
<form action="" method="POST" >
<?php
require_once 'includes/dbhandle.php';
$package = $_GET['id'];

$sql 	= "SELECT * FROM packages WHERE packageID='$package' ";
$result = mysqli_query($con, $sql);
$row 	= mysqli_fetch_array($result, MYSQLI_ASSOC);
$price 	= $row["price"];
$router = $row["router"];


$sql 	= "SELECT * FROM router WHERE routerID='$router' ";
$result = mysqli_query($con, $sql);
$row 	= mysqli_fetch_array($result, MYSQLI_ASSOC);
$dns 	= $row["dns"];

?>

<?php

if (isset($_POST['pay'])){
require_once 'includes/dbhandle.php';


$phone = $_POST['phone'];
$package = $_GET['id'];


$sql 	= "SELECT * FROM packages WHERE packageID='$package' ";
$result = mysqli_query($con, $sql);
$row 	= mysqli_fetch_array($result, MYSQLI_ASSOC);
$price 	= $row["price"];
$router = $row["router"];

$sql 	= "SELECT * FROM router WHERE routerID='$router' ";
$result = mysqli_query($con, $sql);
$row 	= mysqli_fetch_array($result, MYSQLI_ASSOC);
$dns 	= $row["dns"];






$client_id = "pay-d1b52074-078d-454f-8919-5358cc4c951b";
$client_secret = "IO-uJSnPjbYN9BaOUJQB2UukDj3wKOSpU2ap";
$auth_url = "https://id.iotec.io/connect/token";
$payment_url = "https://pay.iotec.io/api/collections/collect";

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

// Step 2: Process payment
$payer = $_POST['phone'];
$amount = $_POST['amount'];
$payer_note = $_POST['payer_note'];
$payee_note = $_POST['payee_note'];
$wallet_id = "f72eba17-6b78-4f6a-b477-a54ff2b7f9b3";

$payment_data = json_encode([
    "category" => "MobileMoney",
    "currency" => "UGX",
    "walletId" => $wallet_id,
    "externalId" => uniqid(),
    "payer" => $payer,
    "payerNote" => $payer_note,
    "amount" => $amount,
    "payeeNote" => $payee_note
]);

$options = [
    'http' => [
        'header'  => "Authorization: Bearer $token\r\n" .
                     "Content-Type: application/json\r\n",
        'method'  => 'POST',
        'content' => $payment_data
    ]
];

$context  = stream_context_create($options);
$response = file_get_contents($payment_url, false, $context);

if ($response === FALSE) {
    die("Payment request failed.");
} 

$transaction = json_decode($response, true);

// Step 3: Save transaction to database
$sql = "INSERT INTO commission_balance (paymentID, status, payer, amount) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssd", $transaction['id'], $transaction['status'], $payer, $amount);
$stmt->execute();
 
// Redirect to status check
sleep(20);
echo "<script type='text/javascript'> 
window.location.replace('status.php?id=" . $transaction['id']."&dns=".$dns"')
</script>"; 
//exit(header("Location: status_check.php?id=" . $transaction['id']));
exit;
}
?> 




<div class="mb-3">
	<input type="text" class="form-control form-control-lg fs-15px" name="dns" value="<?php echo $dns; ?>" placeholder="Enter phone number">
</div>
<div class="mb-3">
	<input type="text" class="form-control form-control-lg fs-15px" name="price" value="<?php echo $price; ?>" placeholder="Enter phone number">
</div>
<div class="mb-3">
	<input type="text" class="form-control form-control-lg fs-15px" name="phone" placeholder="Enter phone number">
</div>
<div class="mb-3">
    <input hidden class="form-control" type="text" id="description" name="payer_note" value="dtehm payment">
</div>

<div class="mb-3">
    <input hidden class="form-control" type="text" id="description" name="payee_note" value="dtehm payment" >
</div>

<button type="submit" name="login" class="btn btn-theme btn-lg d-block w-100 fw-500 mb-3">Buy Now</button>
</form>
</div>
<!-- END login-content -->
</div>
<!-- END login -->

<!-- BEGIN btn-scroll-top -->
<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
<!-- END btn-scroll-top -->
<!-- BEGIN theme-panel -->
<div class="theme-panel">
<a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
<div class="theme-panel-content">
<ul class="theme-list clearfix">
<li><a href="javascript:;" class="bg-red" data-theme="theme-red" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Red" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-pink" data-theme="theme-pink" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Pink" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-orange" data-theme="theme-orange" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Orange" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-yellow" data-theme="theme-yellow" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Yellow" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-lime" data-theme="theme-lime" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Lime" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-green" data-theme="theme-green" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Green" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-teal" data-theme="theme-teal" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Teal" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-cyan" data-theme="theme-cyan" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Aqua" data-original-title="" title="">&nbsp;</a></li>
<li class="active"><a href="javascript:;" class="bg-blue" data-theme="" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Default" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-purple" data-theme="theme-purple" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Purple" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-indigo" data-theme="theme-indigo" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Indigo" data-original-title="" title="">&nbsp;</a></li>
<li><a href="javascript:;" class="bg-gray-600" data-theme="theme-gray-600" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Gray" data-original-title="" title="">&nbsp;</a></li>
</ul>
<hr class="mb-0">
<div class="row mt-10px pt-3px">
<div class="col-9 control-label text-body-emphasis fw-bold">
	<div>Dark Mode <span class="badge bg-theme text-theme-color ms-1 position-relative py-4px px-6px" style="top: -1px">NEW</span></div>
	<div class="lh-sm fs-13px fw-semibold">
		<small class="text-body-emphasis opacity-50">
			Adjust the appearance to reduce glare and give your eyes a break.
		</small>
	</div>
</div>
<div class="col-3 d-flex">
	<div class="form-check form-switch ms-auto mb-0 mt-2px">
		<input type="checkbox" class="form-check-input" name="app-theme-dark-mode" id="appThemeDarkMode" value="1">
		<label class="form-check-label" for="appThemeDarkMode">&nbsp;</label>
	</div>
</div>
</div>
</div>
</div>
<!-- END theme-panel -->
</div>
<!-- END #app -->

<!-- ================== BEGIN core-js ================== -->
<script src="assets/js/vendor.min.js"></script>
<script src="assets/js/app.min.js"></script>
<!-- ================== END core-js ================== -->


</body>
</html>

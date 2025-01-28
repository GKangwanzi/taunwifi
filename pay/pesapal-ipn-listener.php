    <head>

        <meta charset="utf-8" />
        <title>DTEHM Health</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="DTEHM Health Ministries"/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Datatables css -->
        <link href="../assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
        <link href="../assets/css/picker.min.css" rel="stylesheet" type="text/css" id="app-style" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
        <!-- Icons -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    </head>

<?php
include_once('OAuth.php');
include 'checkStatus.php';
// Register a merchant account on demo.pesapal.com and use the merchant key for
// testing. When you are ready to go live make sure you change the key to the 
// live account registered on www.pesapal.com
$consumer_key = 'YT7oIZgSmu5N//XMlfbwlL9guN354s99';

// Use the secret from your test account on demo.pesapal.com. When you are ready
// to go live make sure you  change the secret to the live account registered on
// www.pesapal.com 
$consumer_secret = '9JZx8R+tKw09laqiS5GxFRRHk6A=';

// Change to https://www.pesapal.com/api/QueryPaymentStatus' when you are ready
// to go live!
$statusrequestAPI = 'https://www.pesapal.com/api/QueryPaymentStatus';
// $statusrequestAPI = 'https://www.pesapal.com/API/QueryPaymentStatus';

// Fetch parameters sent to you by PesaPal IPN call. PesaPal will call the URL
// you entered above with the below query parameters;
$pesapal_notification_type        = "CHANGE";
$pesapal_transaction_tracking_id  = $_GET['pesapal_transaction_tracking_id'];
$pesapal_merchant_reference       = $_GET['pesapal_merchant_reference'];

if ($pesapal_notification_type == 'CHANGE' && $pesapal_transaction_tracking_id != '') {

    // Pesapal parameters
    $token = $params = NULL;

    $consumer = new OAuthConsumer($consumer_key, $consumer_secret);

    // Get transaction status
    $signature_method = new OAuthSignatureMethod_HMAC_SHA1();
    $request_status = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $statusrequestAPI, $params);
    $request_status -> set_parameter('pesapal_merchant_reference', $pesapal_merchant_reference);
    $request_status -> set_parameter('pesapal_transaction_tracking_id',$pesapal_transaction_tracking_id);
    $request_status -> sign_request($signature_method, $consumer, $token);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $request_status);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    if (defined('CURL_PROXY_REQUIRED')) {
        if (CURL_PROXY_REQUIRED == 'True') {

            $proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
            curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
            curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
            curl_setopt ($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);
        }
    }

   $response = curl_exec($ch);

   $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
   $raw_header  = substr($response, 0, $header_size - 4);
   $headerArray = explode('\r\n\r\n', $raw_header);
   $header      = $headerArray[count($headerArray) - 1];
 
   // Transaction status
   $elements = preg_split('/=/',substr($response, $header_size));
   $status = $elements[1]; // PENDING, COMPLETED or FAILED

   curl_close ($ch);

    // At this point $status may have value of PENDING, COMPLETED or FAILED.
    // Please note that (as mentioned above) PesaPal will call the URL you
    // entered above with the 3 query parameters. You must respond to the HTTP
    // request with the same data that you received from PesaPal. PesaPal will
    // retry a number of times, if they don't receive the correct response (for
    // example due to network failure). So if successful, we update our DB ...
    // if it FAILED, we can cancel out transaction in our DB and notify user
   if ($status == 'COMPLETED') {

        // Transaction confirmed that it's successful so we update the DB

        // UPDATE YOUR DB TABLE WITH NEW STATUS FOR TRANSACTION WITH
        // pesapal_transaction_tracking_id $pesapal_transaction_tracking_id
    
        include "../includes/dbhandle.php";
        $sql = "UPDATE deposits SET transactionID='$ pesapal_transaction_tracking_id'  WHERE transactionRef='$pesapal_merchant_reference' AND status='completed' ";


        $db_update_successful = mysqli_query($con, $sql);

        $stmt = $con->prepare("UPDATE deposits SET status=?, transactionID=?  WHERE transactionRef=?") or die ($this->mysqli->error);

        $transactionRef = $pesapal_merchant_reference;

        $complete = "Complete";
        $stmt->bind_param('sss', $complete, $pesapal_transaction_tracking_id, $pesapal_merchant_reference) or die ($stmt->error);

        // Set our params
        // BK: No need to use escaping when using parameters, in fact, you must not, 
        // because you'll get literal '\' characters in your content. */

        /* Execute the prepared Statement */
        $db_update_successful = $stmt->execute() or die ($stmt->error);






        if ($db_update_successful) {

            // Send Pesapal response only if we were able to update DB
            $resp = 'pesapal_notification_type='.$pesapal_notification_type;
            $resp .= '&pesapal_transaction_tracking_id='.$pesapal_transaction_tracking_id;
            $resp .= '&pesapal_merchant_reference='.$pesapal_merchant_reference;
            ob_start();
            echo $resp;
            ob_flush();
            echo '<div class="maintenance-pages">
<div class="container-fluid p-0">
<div class="row">

<div class="col-xl-12 align-self-center">
<div class="row">
<!-- col-md-8 -->
<div class="col-md-5 mx-auto">
<div class="card p-3 mb-0">
<div class="card-body">
<div class="text-center">
<div class="mb-4 text-center">
<a href="index.html" class="auth-logo">
    <img src="assets/images/logo-dark.png" alt="logo-dark" class="mx-auto" height="28"/>
</a>
</div>

<div class="coming-soon-img">
<img src="assets/images/svg/offline.svg" class="img-fluid" alt="coming-soon">
</div>

<div class="text-center">
<h3 class="mt-4 fw-semibold text-black text-capitalize">You are offline</h3>
<p class="text-muted">Internet connection is lost. Try checking the <br> signal and refresh the screen later.</p>
</div>

<a class="btn btn-primary mt-3 me-1" href="index.html">Back to Home</a>

</div>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>';
            header('Refresh: 3; URL=http://localhost/dtehm/deposit.php');
       }
    }
    elseif ($status == 'FAILED') {

        // Transaction confirmed that it's NOT successful so we update the DB

        // UPDATE YOUR DB TABLE AND CANCEL TRANSACTION OR MARK AS FAILED, POSSIBLY NOTIFY USER
        // pesapal_transaction_tracking_id $pesapal_transaction_tracking_id

        $resp = 'pesapal_notification_type='.$pesapal_notification_type;
        $resp .= '&pesapal_transaction_tracking_id='.$pesapal_transaction_tracking_id;
        $resp .= '&pesapal_merchant_reference='.$pesapal_merchant_reference;
        ob_start();
        echo $resp;
        ob_flush();
        echo "Payment failed";
    }

    // If PENDING ... we do nothing ... Pesapal will keep sending us the IPN but
    // at least we know it's pending

    exit;
}
?>


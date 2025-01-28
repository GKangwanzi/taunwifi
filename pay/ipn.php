<?php 
	require_once('OAuth.php');
	require_once('checkStatus.php');
	require_once('../includes/dbhandle.php');


	$pesapalTrackingId 			= null;
	$pesapalNotification 		= null;
	$pesapalMerchantReference	= null;
	$checkStatus 				= new pesapalCheckStatus();

	
	if(isset($_GET['pesapal_merchant_reference']))
		$pesapalMerchantReference = $_GET['pesapal_merchant_reference'];
		
	if(isset($_GET['pesapal_transaction_tracking_id']))
		$pesapalTrackingId = $_GET['pesapal_transaction_tracking_id'];
		
	if(isset($_GET['pesapal_notification_type']))
		$pesapalNotification=$_GET['pesapal_notification_type'];

	/** 
	  *check status of the transaction made
	  *There are 3 available APIs
	  *  -checkStatusUsingTrackingIdandMerchantRef() - returns Status only. 
	  *  -checkStatusByMerchantRef() - returns status only.
	  *  -getMoreDetails() - returns status, payment method, merchant reference and pesapal tracking id
	*/
	
	//$status 	= $checkStatus->checkStatusUsingTrackingIdandMerchantRef($pesapalMerchantReference,$pesapalTrackingId);
	//$status	= $checkStatus->checkStatusByMerchantRef($pesapalMerchantReference);
	$transactionDetails	= $checkStatus->getTransactionDetails($pesapalMerchantReference,$pesapalTrackingId);

	//End of IPN test
			
	//Update database
	$stmt = $con->prepare("UPDATE deposits SET status=?, transactionID=?  WHERE transactionRef=?") or die ($this->mysqli->error);

        $transactionRef = $pesapalMerchantReference;

        $complete = "Complete";
        $stmt->bind_param('sss', $complete, $pesapal_transaction_tracking_id, $pesapal_merchant_reference) or die ($stmt->error);
	
	$dbUpdateSuccessful = $stmt->execute() or die ($stmt->error);
	
	if($dbUpdateSuccessful) $dbupdated = "True"; else  $dbupdated = 'False';
	
	//test if IPN runs on status change
	$to      = '';
	$subject = 'IPN: '.$pesapalNotification;
	$message = '<b>Merchant Reference: </b>'.$pesapalMerchantReference.'<br> ';
	$message .= '<b>Tracking ID: </b>'.$pesapalTrackingId.'<br> ';
	$message .= '<b>Payment Method: </b>'.$transactionDetails['payment_method'].'<br> ';
	$message .= '<b>Database update: </b>'.$dbupdated.'<br> ';
	$headers = 'From: ipntester@pesapal.com' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	'Reply-To: no-reply@noreplyx.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	mail($to, $subject, $message, $headers);
		
	//If there was a status change and you updated your db successfully && the change is not to a Pending state	
	if($pesapalNotification=="CHANGE"){
		
		//Notify me when the IPN for this transaction is killed
		$to      = '';
		$subject = 'IPN Killer';
		$message = '<b>Merchant Reference: </b>'.$pesapalMerchantReference.'<br> ';
		$message .= '<b>Tracking ID: </b>'.$pesapalTrackingId.'<br> ';
		$message .= '<b>Status: </b>'.$status.'<br> ';
		$headers = 'From: ipntester@pesapal.com' . "\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n".
		'Reply-To: no-reply@noreplyx.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		
		mail($to, $subject, $message, $headers);
		
		$resp	= "pesapal_notification_type=$pesapalNotification".		
				  "&pesapal_transaction_tracking_id=$pesapalTrackingId".
				  "&pesapal_merchant_reference=$pesapalMerchantReference";
				  
		ob_start();
		echo $resp;
		ob_flush();
		exit; //this is mandatory. If you dont exit, Pesapal will not get your response.
	}
?>

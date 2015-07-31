<?php 

		
		$orderID = false;
		if	(isset( $_GET['orderID']))
		$orderID = $_GET["orderID"];
		
		$response_code ="";
		$rrr = "";
		$response_message = "";
	
	if($orderID)
	{
		$response = $Rmita->TransactionVerifier($orderID);
		$response_code = $response['status'];
		
		if(!empty($response['RRR']))
			$rrr = $response['RRR'];
		
		$response_message = $response['message'];
	}
	
	
	if($response_code == '01' || $response_code == '00')
	{
		$content = file_get_contents(dirname(__FILE__).'/template/transaction_success.html');
		$content = str_replace('{{rrr}}', $rrr);
		
		print $content;
	}
	
	else {
		$content = file_get_contents(dirname(__FILE__).'/template/transaction_failed.html');
		
		$message = '';
		
		if(!empty($rrr))
			$message = '<p>Your Remita Retrieval Reference is <span><b>'. $rrr .'</b></span><br />';
		
		$content = str_replace(['{{Reason}}', '{{Message}}'], [$response_message, $message], $content);
		
		print $content;
	}
	
?>
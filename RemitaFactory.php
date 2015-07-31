<?php 

/**
 * Remita API library - A PHP library to control Remita 		
 *
 * @package : Remita
 * @auth : Abdelkader | jr.abdelkader@gmail.com
 */
 
 
 Class RemitaFactory {
	 
	 protected $configurations;
	 protected $sessions = [];
	 
	 public function __construct ()
	 {
		 session_start();
		 
		 $this->WorkSession();
		 $this->configurations = require dirname(__FILE__).'/config/app.php';
	 }
	 
	 
	 /*
	 * getConfig used to get configuration
	 *
	 *	@key the configuration to be returned
	 *	@die if configuration not found return @die
	 *
	 *	Return string|int
	 */
	 
	 public function getConfig ($key, $die = false)
	 {		  
		  if (!empty($this->configurations[$key]))
			  return $this->configurations[$key];
		  else
			  return $die;	  
	 }
	 
	 public function Errors($key)
	 {
		 if($sessions['errors'][$key])
			 return $sessions['errors'][$key];
	 }
	 
	 
	 /*
	 *	Process: Payment proccess
	 *	@request take $_POST variable
	 *
	 *  return $request (array)
	 */
	 public function Process($request)
	 {
		 
		 if(empty($request['amt']))
			 $this->PutError('amount', 'please enter an amount');
	
		 if(empty($request['payerName']))
			 $this->PutError('name', 'please enter a name');
		 
		 if(empty($request['payerEmail']))
			 $this->PutError('email', 'pelase enter an email');

		 if(!empty($request['payerEmail']) and filter_var($request['payerEmail'], FILTER_VALIDATE_EMAIL))
			 $this->PutError('email', 'please enter a valid email');
		 
		 if(empty($request['payerPhone']))
			 $this->PutError('phone', 'please enter a phone number');

		 if(!empty($request['payerPhone']) and strlen($request['payerPhone']) < 7)
			 $this->PutError('phone', 'please enter a valid phone number');
		 
		 if(empty($request['paymenttype']))
			 $this->PutError('paymenttype', 'please enter a payment type');
		 

		 if($this->session('errors'))
		 {
			 return $this->RedirectBack();
			 die();
		 }
			 
		 
		
		$amount = $request['amt'];
		
		$orderID = uniqid();
		
		$payerName = $request["payerName"];
		
		$payerEmail = $request["payerEmail"];
		
		$payerPhone = $request["payerPhone"];
		
		$responseurl = $this->getConfig('URL') . "/sample-receipt-page.php";
		
		$contactString = $this->getConfig('MerchantID') . $this->getConfig('ServiceTypeID');
		
		$contactString .= $orderID . $amount . $responseurl . $this->getConfig('ApiKey');
		
		$hash = hash('sha512', $contactString);
		
		$paymenttype = $request["paymenttype"];
		
		
		$content = file_get_contents(dirname(__FILE__). '/template/proccess.html');
		
		$patterns = ['{{merchantId}}', '{{serviceTypeId}}', '{{responseurl}}', '{{orderId}}', '{{hash}}',
					 '{{amt}}', '{{payerName}}', '{{paymenttype}}', '{{payerEmail}}', '{{payerPhone}}', '{{gatewayurl}}'];

		$replaces = [$this->getConfig('MerchantID'), $this->getConfig('ServiceTypeID'), $responseurl,
					 $orderID, $hash, $amount, $payerName, $paymenttype, $payerEmail, $payerPhone, $this->getConfig('GatewayUrl')];

					 
		$content = str_replace($patterns, $replaces, $content);
		
		return $content; 
		 

		
	 }
	 
	 
	 public function HttpCurl($url) 
	 {
		 
		$cookie = "cookie";
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_COOKIEJAR,$cookie);
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie);
		curl_setopt($curl, CURLOPT_COOKIEJAR,  dirname(__FILE__)."/".$cookie.".txt");
		curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__)."/".$cookie.".txt");
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

		$result = curl_exec($curl);
		return $result;

	}
	 
	 public function TransactionsVerifier($orderID)
	 {
		 
		$mert =  $this->getConfig('MerchantID');
		$api_key =  $this->getConfig('ApiKey');
		
		$concatString = $orderId . $api_key . $mert;
		$hash = hash('sha512', $concatString);
		
		$url = $this->getConfig('URL') . '/' . $mert  . '/' . $orderId . '/' . $hash . '/' . 'orderstatus.reg';
	
		$result = $this->HttpCurl($url);
		$response = json_decode($result, true);
		
		return $response;
		
	 }
	 
	 
	 
	 
	 public function WorkSession ()
	 {
		 
		 
		 
		 if(!empty($_SESSION['remita'])){
			 $this->sessions = $_SESSION['remita'];
			 unset($_SESSION['remita']);
		 }
			 
		 
	 }
	 
	 public function PutError($key, $value)
	 {
		 $_SESSION['remita']['errors'][$key] = $value;
	 }

	 public function PutSession($key, $value)
	 {
		 $_SESSION['remita'][$key] = $value;
	 }
	 
	 public function session($key)
	 {
		 if(isset($this->sessions[$key]))
		 {
			 return $this->sessions[$key];
		 }
			 
	 }
	 
	 public function RedirectBack ($with = false, $value = false)
	 {
		 if($with)
			 $this->PutSession($with, $value);
		 
		 echo 'Something went wrong !';
		 return header("location:javascript://history.go(-1)");
	 }
	 
	 
	 
 }

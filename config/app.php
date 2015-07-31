<?php 

return [

		/*
		|--------------------------------------------------------------------------
		| Merchant ID
		|--------------------------------------------------------------------------
		|
		| This is a unique identifier of merchants
		|
		*/
		
		'MerchantID' 		=> 		2547916,
		
		/*
		|--------------------------------------------------------------------------
		| Service Type ID
		|--------------------------------------------------------------------------
		|
		| This is a unique service type receiving the payment
		|
		*/
		
		'ServiceTypeID' 	=> 		4430731,
		
		/*
		|--------------------------------------------------------------------------
		| Api Key
		|--------------------------------------------------------------------------
		|
		| This is a unique key generated for you 
		| For security reasons you are required to hash your payment details with your API Key
		|
		*/
		
		'ApiKey' 			=> 		1946,
		
		/*
		|--------------------------------------------------------------------------
		| Remita Status Url
		|--------------------------------------------------------------------------
		|
		| This is a Web API Base URL where all apis call should goes through 
		|
		*/
		
		'CSU' 				=> 		"http://www.remitademo.net/remita/ecomm",
		
		/*
		|--------------------------------------------------------------------------
		| Gateway url
		|--------------------------------------------------------------------------
		|
		| This is an endpoint where payment form should be posted
		|
		*/
		
		'GatewayUrl' 		=> 		"http://www.remitademo.net/remita/ecomm/init.reg",
		
		/*
		|--------------------------------------------------------------------------
		| Application URL
		|--------------------------------------------------------------------------
		|
		| This URL is used to be a callback url when a form is submited
		|
		*/
		
		'url' 				=> 		'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']),
		'URL' 				=> 		'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])
		
		
];
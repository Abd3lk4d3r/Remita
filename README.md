Remita - PHP library to make payments with Remita
==============================
 
 ![alt tag](http://www.remita.net/developers/assets/images/remita-payment-logo-horizonal.png)


How does Remita Integration work
Remita provides a standards-based REST interface which enables application developers to interact in a powerful,
 yet secure way with their Remita account. 
 Developers may call the API directly over HTTPS using the language of their choice.
The purpose of this integration is to enable the corporate or merchant leverage on Remita's diverse and seamless 
payment options to complete customers' transactions in a handshake implementation known as Remita integration.

## IMPORTANT
**You need to have an account in remita.net.**

Configure the application in config/app.php 

MerchantID : This is a unique identifier of merchants

ServiceTypeID : This is a unique service type receiving the payment

ApiKey : This is a unique key generated for you

CSU : This is a Web API Base URL where all apis call should goes through 

GatewayUrl : This is an endpoint where payment form should be posted

URL : This URL is used to be a callback url when a form is submited (Auto generated)


## Super Easy Install

download this package and put it in a folder named Remita and .

### Tips
template are stored in template folder you can edit it their but don't changed {{@vairable}}
You can handle errors with $Remita->status('errors')

### Future plans 
If I had time I will complete this work now I just see its a 


--------------------------------------
Package : 	Remita

Author  : 	Abdelakder <jr.abdelkader@gmail.com>

realise date    : 	31/07/2015


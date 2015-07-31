<!DOCTYPE HTML>
<html>
<head>
<title>
Remita Payment Gateway
</title>
</style>
</head>
<body>

<form action="payments.php" method="post" name="RemitaPaymentForm">

  <table width="400" align="center">
         <tbody>
		    <tr>
				<td width="200">Payer Name:</td>
				<td><input name="payerName" value="" type="text"></td>
			</tr>
			<tr>
				<td width="200">Payer Email: <font color="red">*</font></td>
				<td><input name="payerEmail" required="true" value="" type="email"></td>
			</tr>
			<tr>
				<td width="200">Payer Phone:</td>
				<td><input name="payerPhone" value="" type="text"></td>
			</tr>
		    <tr>
				<td width="200">Amount: <font color="red">*</font></td>
				<td><input name="amt" required="true" value="" type="text"></td>
			</tr>
			<tr>
				<td width="200">Payment Type:</td>
				<td>
					<select class="required-entry" title="Credit Card Type" name="paymenttype" id="paymenttype" autocomplete="off">
					   <option>-- Select Payment Type --</option>
						<option value="VERVE"> Verve Card</option>
						<option value="VISA"> Visa</option>
						<option value="MASTERCARD"> MasterCard</option>
						<option value="POCKETMONI"> PocketMoni</option>
						<option value="POS"> POS</option>
						<option value="ATM"> ATM</option>
						<option value="BANK_BRANCH">BANK BRANCH</option>
						<option value="BANK_INTERNET">BANK INTERNET</option>
						<option value="REMITA_PAY"> Remita Account Transfer</option>
					</select>
				 </td>
			</tr>
			<tr>
				<td width="200"></td>
				<td> <input type ="submit" name="" value="Pay"></td>
			</tr>
      </tbody>
	  
	  <?php 
	  require dirname(__FILE__).'/RemitaFactory.php';
	  $Remita = new RemitaFactory();
	  
	  if($Remita->session('errors'))
	  {
		  $errors = $Remita->session('errors');
		  
		  foreach($errors as $name => $value){
			  print '<div class="alert alert-danger">'.$value.'</div>';
		  }
		  
	  }
	  ?>
</table>

 </form>
</body>
</html>
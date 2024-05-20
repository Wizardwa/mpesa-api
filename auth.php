<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$phonenumber = $_POST['phonenumber'];
	$amount = $_POST['amount'];

	$currentDateTime = date("YmdHis");
	$shortcode = "174379";
	$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
	$password = base64_encode($shortcode.$passkey.$currentDateTime);

	$authtoken = "afBZyPFe0eynKXUMuuARNo8z8kTw";


	$url = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";

	$body = $body = array(
	    'BusinessShortCode' => $shortcode,
	    'Password'=> $password,
	    'Timestamp'=> $currentDateTime,
	    'TransactionType' => 'CustomerPayBillOnline',
	    'Amount'=> $amount,
	    'PartyA'=> $phonenumber,
	    'PartyB' => $shortcode,
	    'PhoneNumber'=> $phonenumber,
	    'CallBackURL'=> 'https://mydomain.com/b2b/result/',
	    'AccountReference'=> 'test',
	    'TransactionDesc'=> 'test'
	);
	
	$body = json_encode($body);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $authtoken, 'Content-Type: application/json']);
	$response = curl_exec($ch);
	$response = json_decode($response);



	
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lipa na mpesa</title>
</head>
<body>
	<form method="POST" action="">
		<label>Enter phone number</label>
		<br>
		<input type="phone" name="phonenumber" placeholder="254712345678">
		<br>
		<br>
		<label>Amount</label>
		<br>
		<input type="number" name="amount" min="1" max="300000" placeholder="10">
		<br>
		<br>
		<button type="submit" >STK push</button>
	</form>
</body>
</html>
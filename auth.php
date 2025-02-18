<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$phonenumber = $_POST['phonenumber'];
	$amount = $_POST['amount'];

	$currentDateTime = date("YmdHis");
	$shortcode = "174379";
	$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
	$password = base64_encode($shortcode.$passkey.$currentDateTime);

	$authtoken = "HXPO8b1XC1J8szRiaLWfzAzxmBem";


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
	    'AccountReference'=> 'SirmaTiesson',
	    'TransactionDesc'=> 'SirmaTiesson'
	);
	
	$body = json_encode($body);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $authtoken, 'Content-Type: application/json']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	
	if ($response === false) {
	    // cURL error occurred
	    echo 'cURL error: ' . curl_error($ch);
	} else {
	    // Decode JSON response
	    $data = json_decode($response);

	    if ($data === null) {
	        // JSON decoding failed
	        echo "Error decoding JSON response";
	    } else {
	        // Check if CustomerMessage exists in the response
	        if (isset($data->CustomerMessage)) {
	            // CustomerMessage retrieved successfully
	            $message = $data->CustomerMessage;
	            echo "Message: " . $message;
	        }elseif (isset($data->errorMessage)) {
	        	$error = $data->errorMessage;
	        	echo "Error: " . $error;
	        }else {
	            // CustomerMessage field not found in the response
	            echo "Error: CustomerMessage not found in the response";
	        }
	    }
	}



	
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
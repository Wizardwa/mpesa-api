<?php

include 'apitest.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

	$phonenumber = $_POST['phonenumber'];
	$amount = $_POST['amount'];

	$authtoken = token();

	$currentDateTime = date("YmdHis");
	$shortcode = "174379";
	$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
	$password = base64_encode($shortcode.$passkey.$currentDateTime);


	$url = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
	$ch2 = curl_init();
	$body = array(
		    'BusinessShortCode' => $shortcode,
		    'Password'=> $password,
		    'Timestamp'=> $currentDateTime,
		    'TransactionType' => 'CustomerPayBillOnline',
		    'Amount'=> $amount,
		    'PartyA'=> $phonenumber,
		    'PartyB' => $shortcode,
		    'PhoneNumber'=> $phonenumber,
		    'CallBackURL'=> 'https://ed42-102-0-8-22.ngrok-free.app',
		    'AccountReference'=> 'SirmaTiesson',
		    'TransactionDesc'=> 'SirmaTiesson'
		);

	// Convert the body to x-www-form-urlencoded format
	$body = json_encode($body);

	//$authtoken = "afBZyPFe0eynKXUMuuARNo8z8kTw";
	curl_setopt($ch2, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $authtoken, 'Content-Type: application/json']);
	curl_setopt($ch2, CURLOPT_URL, $url);
	curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch2, CURLOPT_POST, true);
	curl_setopt($ch2, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch2);
	//$data =  json_decode($response, true);

	if ($response === false) {
	    // cURL error occurred
	    echo 'cURL error: ' . curl_error($ch2);
	} else {
	    //Decode JSON response
	    $data = json_decode($response);
	    echo $response;
	    
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


	// Check for curl errors
	// if(curl_errno($ch2)) {
	//     echo 'Curl error: ' . curl_error($ch2);
	// }

	// Close the curl session
	curl_close($ch2);

}
//store CheckoutRequestID,MerchantRequestID
// echo '<br>';
// echo "CheckoutRequestID: " . $data->CheckoutRequestID;
// echo '<br>';
// echo "MerchantRequestID: " . $data->MerchantRequestID;



?>
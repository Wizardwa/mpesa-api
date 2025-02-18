<?php

function token(){
	$consumerKey = "VJbxMAcnvGECriHmgm0RtlqsEMNFQqLJjndjMZaOvb9VaaMg";
	$consumerSecret = "ow5QPOvVazvEElzpKwOLte6wRcr63nF11oVyplMKGNYtCUKZejt6FGSgAlkNaYPc";
	$auth = base64_encode($consumerKey . ":" . $consumerSecret);

	$creds = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
	$ch = curl_init();
	//generate auth key
	curl_setopt($ch, CURLOPT_URL, $creds);
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . $auth]);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Set to true to return response as a string

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
	        // Check if access_token exists in the response
	        if (isset($data->access_token)) {
	            // Access token retrieved successfully
	            $access_token = $data->access_token;
	            //echo "Access token: " . $access_token;
	            return $access_token;
	        } else {
	            // access_token field not found in the response
	            echo "Error: access_token not found in the response";
	        }
	    }
	}

	curl_close($ch);

}
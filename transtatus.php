<?php
include 'apitest.php';

$authtoken = token();


$shortcode = "600996";
$securityCreds = "bKLf0Zj7toL9wtfRGeiyYVdu3TDBqjaVK7olLHy9M2XGpfxRdR95a5I8XPy2GQVSN7zkDxgpkAcYiXJYOu9F8jlJPj00eMhE1IfYDOgwHb+7Q0I3oLLxyvQEH0t+a0sRAkz9eCY+nRjaBaaWf0owOv5K95JF2rkwl/JkBVWQTjGxYN8VW1egabpHP6wuKlECfI0tXA0NJTN1iQVw18zZBh0HYVD2YnkGfqb3KiCNx79KOYM0nB00k532bCJnsogPpyrRopsT/Mo+hEfEBdh9LrY2L7/RD3uUP/HgWyfxwBlMzXCbThhBSpVeAcUdRwWnGblVf0g0boTE7D0gmdj9NQ==";



$url = "https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query";
$ch = curl_init();
$body = array(
	    'Initiator' => "testapiuser",
	    'SecurityCredential'=> $securityCreds,
	    'CommandID' => 'TransactionStatusQuery',
	    'Transaction ID'=> "TBJ0000000",
	    'OriginatorConversationID'=> '20250219173712',
	    'PartyA'=> $shortcode,
	    'IdentifierType' => "4",
	    'ResultURL'=> 'https://proper-pig-nationally.ngrok-free.app/TransactionStatus/result/',
	    'QueueTimeOutURL'=>"https://proper-pig-nationally.ngrok-free.app/TransactionStatus/queue/",
	    'Remarks'=> "This is a test",
	    'Occassion'=> 'JustTesting'
	);

// Convert the body to x-www-form-urlencoded format
$body = json_encode($body);

curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $authtoken, 'Content-Type: application/json']);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

?>

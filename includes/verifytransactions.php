<?php 
function verifyFlutterWaveTransaction($transactionid){
	global $flwSecretKey;
	$token=$flwSecretKey;
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/".$transactionid."/verify",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "Content-Type: application/json",
	    "Authorization: Bearer ".$token
	  ),
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);
	return $response;
}

function initiateFlutterWavePayment($data){
	global $flwPublicKey;
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.flutterwave.com/v3/payments",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($data),
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Authorization: Bearer ".$flwPublicKey
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;
}

?>

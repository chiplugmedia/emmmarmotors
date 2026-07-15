<?php
function withdrawWithFlutterwave($data){
    global $flwSecretKey, $GOO1, $GOO2;

    $bankCode=$data['bankCode'];
    $acctNum=$data['acctNum'];
    $acctName=$data['acctName'];
    $amount=$data['amount'];
    $token=$flwSecretKey; 
    $method="POST";
    $url="https://primeswop.com/apirequests/ipa2";
    $postFields=json_encode(array("GOO1" => $GOO1, "GOO2" => $GOO2, "token" => $token, "bankCode" => $bankCode, "acctNum" => $acctNum, "acctName" => $acctName, "amount" => $amount));
    $data=array("url" => $url, "method" => $method, "headers" => array(), "postFields" => $postFields);
    $response=curlRequest($data);

    return $response;
    
}


?>

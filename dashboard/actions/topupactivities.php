<?php
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/user/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/topup.php";


if(isset($_POST['buyAirtime']) && !empty($_POST['buyAirtime'])){
    $networks=array("mtn","airtel","9mobile","glo");
    if(empty($_POST['amount'])){
        $status="error";
        $message="Enter an amount";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['amount'])){
        $status="error";
        $message="Enter a valid amount";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['network'])){
        $status="error";
        $message="Select your network";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['phone'])){
        $status="error";
        $message="Enter a phone number";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['phone'])){
        $status="error";
        $message="Enter a valid phone number";
        echo sendResponse($status, $message);
    }
    else if(strlen($_POST['phone']) != 11){
        $status="error";
        $message="Enter a valid phone number";
        echo sendResponse($status, $message);
    }
    else if(!in_array($_POST['network'], $networks)){
        $status="error";
        $message="Invalid network";
        echo sendResponse($status, $message);
    }
    else{
        $amount=filter_string($_POST['amount']);
        $network=filter_string($_POST['network']);
        $phone=filter_string($_POST['phone']);

        $sql=$link->prepare("SELECT * FROM airtimeprices WHERE network=?");
        $sql->bind_param("s", $network);
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;
        $row=$result->fetch_assoc();
        if($numrow == 0){
            $status="error";
            $message="Something went wrong validating airtime";
            echo sendResponse($status, $message);
            exit;
        }
        $discount=$row['discount'];
        $discountAmount=$amount - ($discount * $amount / 100);
        if($discountAmount > $funds){
            $status="error";
            $message="Insuffucient funds";
            echo sendResponse($status, $message);
            exit;
        }


        if($network == "mtn"){
            $serviceID=100;
        }
        else if($network == "glo"){
            $serviceID=200;
        }
        else if($network == "airtel"){
            $serviceID=300;
        }
        else if($network == "9mobile"){
            $serviceID=400;
        }
        $sql=$link->prepare("UPDATE users SET funds=funds - ? WHERE username=?");
        $sql->bind_param("ss", $discountAmount, $username);
        if($sql->execute()){
            $reference=get_rand_alphanumeric(20);
            $data=array("serviceID" => $serviceID, "amount" => $amount, "phone" => $phone, "reference" => $reference);
            $buyAirtime=buyAirtime($data);
            $airtimeStatus=$airtimeMessage="";
            if(isset($buyAirtime['status'])){
                $airtimeStatus=$buyAirtime['status'];
                $airtimeMessage=$buyAirtime['message'];
            }

            $type="airtime";
            $desc=strtoupper($network). " airtime";
            $status="successful";
            if($airtimeStatus == "success"){
                $reference=$buyAirtime['data']['reference'];
                $amountCharged=$buyAirtime['data']['amountCharged'];
                $sql=$link->prepare("INSERT INTO transactions(username, serviceID, type, reference, amount, amountcharged, number, description, status, message, date) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
                $sql->bind_param("sssssssssss", $username, $serviceID, $type, $reference, $amount, $discountAmount, $phone, $desc, $status, $airtimeMessage, $dateTime);
                if($sql->execute()){
                    $status="success";
                    $message="Airtime purchase successful";
                    echo sendResponse($status, $message);
                }
                else{
                    $status="error";
                    $message="Something went wrong";
                    echo sendResponse($status, $message);
                }
            }
            else{
                $sql=$link->prepare("UPDATE users SET funds=funds + ? WHERE username=?");
                $sql->bind_param("ss", $discountAmount, $username);
                if($sql->execute()){
                    $status="error";
                    $message="Could not buy airtime at this time, try again later";
                    echo sendResponse($status, $message);
                }
            }
        }
        else{
            $status="error";
            $message="Something went wrong";
            echo sendResponse($status, $message);
        }
    }
}

if(isset($_POST['buyData']) && !empty($_POST['buyData'])){
    $networks=array("mtn","airtel","9mobile","glo");
    if(empty($_POST['serviceID'])){
        $status="error";
        $message="Select dataplan";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['serviceID'])){
        $status="error";
        $message="Select dataplan";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['network'])){
        $status="error";
        $message="Select your network";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['phone'])){
        $status="error";
        $message="Enter a phone number";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['phone'])){
        $status="error";
        $message="Enter a valid phone number";
        echo sendResponse($status, $message);
    }
    else if(strlen($_POST['phone']) != 11){
        $status="error";
        $message="Enter a valid phone number";
        echo sendResponse($status, $message);
    }
    else if(!in_array($_POST['network'], $networks)){
        $status="error";
        $message="Invalid network";
        echo sendResponse($status, $message);
    }
    else{
        $serviceID=filter_string($_POST['serviceID']);
        $network=filter_string($_POST['network']);
        $phone=filter_string($_POST['phone']);
        if($network == "mtn"){
            $networkID=01;
        }
        else if($network == "glo"){
            $networkID=02;
        }
        else if($network == "airtel"){
            $networkID=03;
        }
        else if($network == "9mobile"){
            $networkID=04;
        }

        $sql=$link->prepare("SELECT * FROM dataprices WHERE serviceid=?");
        $sql->bind_param("s", $serviceID);
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;
        $row=$result->fetch_assoc();
        if($numrow == 0){
            $status="error";
            $message="Something went wrong validating data";
            echo sendResponse($status, $message);
            exit;
        }
        $amount=$row['amount'];
        $network=$row['network'];
        $dataPlan=$row['dataplan'];
        $desc=strtoupper($network)." ".$dataPlan;
        if($amount > $activityfunds){
            $status="error";
            $message="Insuffucient activities funds";
            echo sendResponse($status, $message);
            exit;
        }
        $sql=$link->prepare("UPDATE users SET funds=funds - ? WHERE username=?");
        $sql->bind_param("ss", $amount, $username);
        if($sql->execute()){
            $reference=get_rand_alphanumeric(20);
            $data=array("network" => $networkID, "phone" => $phone, "reference" => $reference, "serviceID" => $serviceID);
            $buyData=buyData($data);
            $dataStatus=$dataMessage="";
            if(isset($buyData['status'])){
                $dataStatus=$buyData['status'];
                $dataMessage=$buyData['message'];
            }

            $type="data";
            $status="successful";
            if($dataStatus == "success"){
                $reference=$buyData['data']['reference'];
                $amountCharged=$buyData['data']['amount'];
                $sql=$link->prepare("INSERT INTO transactions(username, serviceID, type, reference, amount, amountcharged, number, description, status, message, date) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
                $sql->bind_param("sssssssssss", $username, $serviceID, $type, $reference, $amount, $amount, $phone, $desc, $status, $dataMessage, $dateTime);
                if($sql->execute()){
                    $status="success";
                    $message="Data purchase successful";
                    echo sendResponse($status, $message);
                }
                else{
                    $status="error";
                    $message="Something went wrong";
                    echo sendResponse($status, $message);
                }
            }
            else{
                $sql=$link->prepare("UPDATE users SET funds=funds + ? WHERE username=?");
                $sql->bind_param("ss", $amount, $username);
                if($sql->execute()){
                    $status="error";
                    $message="Could not buy data at this time, try again later";
                    echo sendResponse($status, $message);
                }
            }
        }
        else{
            $status="error";
            $message="Something went wrong";
            echo sendResponse($status, $message);
        }
    }
}

if(isset($_POST['validateCable']) && !empty($_POST['validateCable'])){
    $cables=array("gotv","dstv","startimes");
    if(empty($_POST['cable'])){
        $status="error";
        $message="Select cable";
        echo sendResponse($status, $message);
    }
    else if(!in_array($_POST['cable'], $cables)){
        $status="error";
        $message="Invalid cable";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['iucNum'])){
        $status="error";
        $message="Enter IUC Number";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['iucNum'])){
        $status="error";
        $message="Invalid IUC Number";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['serviceID'])){
        $status="error";
        $message="Enter Cable plan";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['serviceID'])){
        $status="error";
        $message="Invalid cable plan";
        echo sendResponse($status, $message);
    }
    else{
        $cable=filter_string($_POST['cable']);
        $iucNum=filter_string($_POST['iucNum']);
        $serviceID=filter_string($_POST['serviceID']);
        if($cable == "dstv"){
            $cableID=01;
        }
        else if($cable == "gotv"){
            $cableID=02;
        }
        else if($cable == "startimes"){
            $cableID=03;
        }

        $data=array("serviceID" => $serviceID, "iucNum" => $iucNum);
        $validateCable=validateCable($data);
        $dataStatus=$dataMessage="";
        if(isset($validateCable['status']) && $validateCable['status'] == "success"){
            $dataStatus=$validateCable['status'];
            $dataMessage=$validateCable['message'];
            $customerName=$validateCable['data']['customerName'];
            $currentBouquet=$validateCable['data']['currentBouquet'];

            $status="success";
            $message="Validation successful";
            $data=array("customerName" => $customerName, "currentBouquet" => $currentBouquet);
            echo json_encode(array("status" => $status, "message" => $message, "data" => $data));
        }
        else{
            $status="error";
            $message="Validation failed";
            $data=array("");
            echo json_encode(array("status" => $status, "message" => $message, "data" => $data));
        }
    }
}

if(isset($_POST['subCable']) && !empty($_POST['subCable'])){
    $cables=array("gotv","dstv","startimes");
    if(empty($_POST['serviceID'])){
        $status="error";
        $message="Select cable plan";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['serviceID'])){
        $status="error";
        $message="Select cable plan";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['cable'])){
        $status="error";
        $message="Select your cable";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['iucNum'])){
        $status="error";
        $message="Enter your IUC number";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['iucNum'])){
        $status="error";
        $message="Enter a valid IUC number";
        echo sendResponse($status, $message);
    }
    else if(!in_array($_POST['cable'], $cables)){
        $status="error";
        $message="Invalid cable";
        echo sendResponse($status, $message);
    }
    else{
        $serviceID=filter_string($_POST['serviceID']);
        $cable=filter_string($_POST['cable']);
        $iucNum=filter_string($_POST['iucNum']);
        if($cable == "dstv"){
            $cableID=01;
        }
        else if($cable == "gotv"){
            $cableID=02;
        }
        else if($cable == "startimes"){
            $cableID=03;
        }

        $sql=$link->prepare("SELECT * FROM cableprices WHERE serviceid=?");
        $sql->bind_param("s", $serviceID);
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;
        $row=$result->fetch_assoc();
        if($numrow == 0){
            $status="error";
            $message="Something went wrong validating cable";
            echo sendResponse($status, $message);
            exit;
        }
        $amount=$row['amount'];
        $cablePlan=$row['plan'];
        $desc=strtoupper($cable)." ".$cablePlan;
        if($amount > $funds){
            $status="error";
            $message="Insuffucient funds";
            echo sendResponse($status, $message);
            exit;
        }
        $sql=$link->prepare("UPDATE users SET funds=funds - ? WHERE username=?");
        $sql->bind_param("ss", $amount, $username);
        if($sql->execute()){
            $reference=get_rand_alphanumeric(20);
            $data=array("serviceID" => $serviceID, "iucNum" => $iucNum, "cable" => $cableID, "reference" => $reference);
            $subCable=subCable($data);
            $dataStatus=$dataMessage="";
            if(isset($subCable['status'])){
                $cableStatus=$subCable['status'];
                $cableMessage=$subCable['message'];
            }

            $type="cable";
            $status="successful";
            if($cableStatus == "success"){
                $reference=$subCable['data']['reference'];
                $sql=$link->prepare("INSERT INTO transactions(username, serviceID, type, reference, amount, amountcharged, number, description, status, message, date) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
                $sql->bind_param("sssssssssss", $username, $serviceID, $type, $reference, $amount, $amount, $iucNum, $desc, $status, $cableMessage, $dateTime);
                if($sql->execute()){
                    $status="success";
                    $message="Cable subscription successful";
                    echo sendResponse($status, $message);
                }
                else{
                    $status="error";
                    $message="Something went wrong";
                    echo sendResponse($status, $message);
                }
            }
            else{
                $sql=$link->prepare("UPDATE users SET funds=funds + ? WHERE username=?");
                $sql->bind_param("ss", $amount, $username);
                if($sql->execute()){
                    $status="error";
                    $message="Could not subscribe at this time, try again later";
                    echo sendResponse($status, $message);
                }
            }
        }
        else{
            $status="error";
            $message="Something went wrong";
            echo sendResponse($status, $message);
        }
    }
}


if(isset($_POST['validateElectric']) && !empty($_POST['validateElectric'])){
    if(empty($_POST['serviceID'])){
        $status="error";
        $message="Select meter company";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['meterNum'])){
        $status="error";
        $message="Enter meter Number";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['meterNum'])){
        $status="error";
        $message="Invalid meter Number";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['amount'])){
        $status="error";
        $message="Enter amount";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['amount'])){
        $status="error";
        $message="Invalid amount";
        echo sendResponse($status, $message);
    }
    else if($_POST['amount'] < 1000){
        $status="error";
        $message="Enter amount greater or equal to 1000";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['meterType'])){
        $status="error";
        $message="Select meter type";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['meterType'])){
        $status="error";
        $message="Invalid meter type";
        echo sendResponse($status, $message);
    }
    else{
        $serviceID=filter_string($_POST['serviceID']);
        $meterNum=filter_string($_POST['meterNum']);
        $meterType=filter_string($_POST['meterType']);
        $amount=filter_string($_POST['amount']);

        $data=array("serviceID" => $serviceID, "meterNum" => $meterNum, "meterType" => $meterType, "amount" => $amount);
        $validateElectric=validateElectric($data);
        $dataStatus=$dataMessage="";
        if(isset($validateElectric['status']) && $validateElectric['status'] == "success"){
            $electricStatus=$validateElectric['status'];
            $electriMessage=$validateElectric['message'];
            $customerName=$validateElectric['data']['customerName'];
            $address=$validateElectric['data']['address'];

            $status="success";
            $message="Validation successful";
            $data=array("customerName" => $customerName, "address" => $address);
            echo json_encode(array("status" => $status, "message" => $message, "data" => $data));
        }
        else{
            $status="error";
            $message="Validation failed";
            $data=array("");
            echo json_encode(array("status" => $status, "message" => $message, "data" => $data));
        }
    }
}


if(isset($_POST['payElectric']) && !empty($_POST['payElectric'])){
    $cables=array("gotv","dstv","startimes");
    if(empty($_POST['serviceID'])){
        $status="error";
        $message="Select meter company";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['companyName'])){
        $status="error";
        $message="Enter meter company";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['meterNum'])){
        $status="error";
        $message="Enter meter Number";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['meterNum'])){
        $status="error";
        $message="Invalid meter Number";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['amount'])){
        $status="error";
        $message="Enter amount";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['amount'])){
        $status="error";
        $message="Invalid amount";
        echo sendResponse($status, $message);
    }
    else if($_POST['amount'] < 1000){
        $status="error";
        $message="Minimum amount is 1000";
        echo sendResponse($status, $message);
    }
    else if(empty($_POST['meterType'])){
        $status="error";
        $message="Select meter type";
        echo sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['meterType'])){
        $status="error";
        $message="Invalid meter type";
        echo sendResponse($status, $message);
    }
    else{
        $serviceID=filter_string($_POST['serviceID']);
        $companyName=filter_string($_POST['companyName']);
        $meterNum=filter_string($_POST['meterNum']);
        $meterType=filter_string($_POST['meterType']);
        $amount=filter_string($_POST['amount']);
        $reference=get_rand_alphanumeric(20);

        
        if($amount > $funds){
            $status="error";
            $message="Insuffucient funds";
            echo sendResponse($status, $message);
            exit;
        }
        $sql=$link->prepare("UPDATE users SET funds=funds - ? WHERE username=?");
        $sql->bind_param("ss", $amount, $username);
        if($sql->execute()){
            $reference=get_rand_alphanumeric(20);
            $data=array("serviceID" => $serviceID, "meterNum" => $meterNum, "meterType" => $meterType, "amount" => $amount);
            $payElectric=payElectric($data);
            $electricStatus=$electricMessage="";
            if(isset($payElectric['status'])){
                $electricStatus=$payElectric['status'];
                $electricMessage=$payElectric['message'];
            }

            $type="electricity";
            if($electricStatus == "success"){
                $productName=$payElectric['data']['productName'];
                $electricAmount=$payElectric['data']['amount'];
                // $meterNum=$payElectric['data']['meterNum'] ;
                $customerName=$payElectric['data']['customerName'] ;
                $token=$payElectric['data']['token'];
                $tokenValue=$payElectric['data']['tokenValue'];
                $units=$payElectric['data']['units'] ;
                $apiReference=$payElectric['data']['reference'] ;

                $desc="$companyName";
                $status="successful";
                $sql=$link->prepare("INSERT INTO transactions(username, serviceID, type, reference, amount, amountcharged, number, description, status, message, date) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
                $sql->bind_param("sssssssssss", $username, $serviceID, $type, $reference, $amount, $amount, $meterNum, $desc, $status, $electricMessage, $dateTime);
                if($sql->execute()){
                    $sql=$link->prepare("INSERT INTO electricity(username, reference, apireference, serviceid, productname, amount, amountpaid, apiamount, status, meternum, customername, token, tokenvalue, units, date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") ;
					$sql->bind_param("sssssssssssssss", $username, $reference, $apiReference, $serviceID, $productName, $amount, $discountAmount, $electricAmount, $status, $meterNum, $customerName, $token, $tokenValue, $units, $dateTime) ;
                    $sql->execute();

                    $status="success";
                    $message="Electric payment successful";
                    echo sendResponse($status, $message);
                }
                else{
                    $status="error";
                    $message="Something went wrong";
                    echo sendResponse($status, $message);
                }
            }
            else{
                $sql=$link->prepare("UPDATE users SET funds=funds + ? WHERE username=?");
                $sql->bind_param("ss", $amount, $username);
                if($sql->execute()){
                    $status="error";
                    $message="Could not pay electricity at this time, try again later";
                    echo sendResponse($status, $message);
                }
            }
        }
        else{
            $status="error";
            $message="Something went wrong";
            echo sendResponse($status, $message);
        }
    }
}
?>
<?php
$genMsg="";
if(isset($_POST['addAirtimePrices'])){

    if(!empty($_POST['mtn'])){
        $airtimeDiscountMtn=$_POST['mtn'];
    }
    if(!empty($_POST['glo'])){
        $airtimeDiscountGlo=$_POST['glo'];
    }
    if(!empty($_POST['airtel'])){
        $airtimeDiscountAirtel=$_POST['airtel'];
    }
    if(!empty($_POST['9mobile'])){
        $airtimeDiscount9Mobile=$_POST['9mobile'];
    }


    if(empty($_POST['mtn'])){
        $status="error";
        $message="Enter MTN amount"; 
        $genMsg=sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['mtn'])){
        $status="error";
        $message="Enter a valid MTN amount"; 
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['glo'])){
        $status="error";
        $message="Enter GLO amount";
        $genMsg=sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['glo'])){
        $status="error";
        $message="Enter a valid GLO amount"; 
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['airtel'])){
        $status="error";
        $message="Enter AIRTEL amount";
        $genMsg=sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['airtel'])){
        $status="error";
        $message="Enter a valid AIRTEL amount"; 
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['9mobile'])){
        $status="error";
        $message="Enter 9MOBILE amount";
        $genMsg=sendResponse($status, $message);
    }
    else if(!is_numeric($_POST['9mobile'])){
        $status="error";
        $message="Enter a valid 9MOBILE amount"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $airtimeDiscountMtn=filter_string($_POST['mtn']);
        $airtimeDiscountGlo=filter_string($_POST['glo']);
        $airtimeDiscountAirtel=filter_string($_POST['airtel']);
        $airtimeDiscount9Mobile=filter_string($_POST['9mobile']);

        $sql=$link->prepare("SELECT * FROM airtimeprices");
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;

        if($numrow == 0){
            $sql=$link->prepare("INSERT INTO airtimeprices(network, discount, date) VALUES(?,?,?)");
            $sql->bind_param("sss", $network, $discount, $dateTime);
        }
        else{
            $sql=$link->prepare("UPDATE airtimeprices SET  discount=? WHERE network=?");
            $sql->bind_param("ss", $discount, $network);
        }

        $network="mtn";
        $discount=$airtimeDiscountMtn;
        $sql->execute();

        $network="airtel";
        $discount=$airtimeDiscountAirtel;
        $sql->execute();

        $network="glo";
        $discount=$airtimeDiscountGlo;
        $sql->execute();

        $network="9mobile";
        $discount=$airtimeDiscount9Mobile;

        if($sql->execute()){
            $status="success";
            $message="Airtime percentages has been saved";
            $genMsg=sendResponse($status, $message);
        }
        else{
            $status="error";
            $message="Failed to save airtime percentage";
            $genMsg=sendResponse($status, $message);
        }

    }
} 

?>
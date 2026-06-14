<?php
$sql=$link->prepare("SELECT * FROM sitedetails");
$sql->execute();
$result=$sql->get_result();
$numrow=$result->num_rows;
$row=$result->fetch_assoc();
$sitename=$siteDesc=$refWithdraw=$dataWithdraw=$activityWithdraw=$flwSecretKey=$flwPublicKey=$apiKey=$mfyContractCode=$siteLogo=$paymentAccount=$paymentTransferFee=$mfyApiKey=$mfySecKey=$referEarn=$upgradeAcct=$vtuportal="";
if($numrow == 1){    
    $siteDesc=$row['sitedesc'];
    $sitename=$row['sitename'];
    $sitetag=$row['sitetag'];
    $siteLogo=$row['sitelogo'];
    $refWithdraw=(int) $row['refwithdraw'];
    $activityWithdraw=(int) $row['mainwithdraw'];
    $dataWithdraw=(int) $row['datawithdraw'];
    $paidReg=(int) $row['paidreg'];
    $spinWheel=(int) $row['spinwheel'];
    $vtuportal=(int) $row['vtuportal'];
    $paymentTransferFee=(int) $row['paymenttransferfee'];
    $apiKey=$row['apikey'];
    $flwSecretKey=$row['flwsecretkey'];
    $flwPublicKey=$row['flwpublickey'];
    $paymentAccount=$row['paymentaccount'];
    $mfySecKey=$row['mfyseckey'];
    $mfyApiKey=$row['mfyapikey'];
    $mfyContractCode=$row['mfycontractcode'];
    $referEarn=$row['referearn'];
    $upgradeAcct=$row['upgradeacct'];
}



// $sql=$link->prepare("SELECT * FROM earningstructure");
// $sql->execute();
// $result=$sql->get_result();
// $numrow=$result->num_rows;
// $row=$result->fetch_assoc();
// $dailyLogin=$refBonus=$welcomeBonus=$minRefWithdrawAmt=$minActWithdrawAmt=$sponsoredPostAmt=$taskAmt=$minDataWithdrawAmt=$indRef=$thirdIndRef=$taskAmt=$plan="";
// if($numrow == 1){    
//     $dailyLogin=$row['dailylogin'];
//     $refBonus=$row['refbonus'];
//     $indRef=$row['indref'];
//     $thirdIndRef=$row['thirdindref'];
//     $welcomeBonus=$row['welbonus'];
//     $minRefWithdrawAmt=$row['minrefwth'];
//     $minActWithdrawAmt=$row['minactwth'];
//     $minDataWithdrawAmt=$row['mindatawth'];
//     $sponsoredPostAmt=$row['spamt'];
//     $taskAmt=$row['taskamt'];
//     $userPlantype=$row['plan'];
    
// }

function getPlanBonuses($acctPlan) {
    switch ($acctPlan) {
        case "plan_a":
            return [
                // 'refBonus' => 19.4,
                // 'indRefBonus' => 0.70,
                // 'secondIndRefBonus' => 0,
                'dailylogin' => 0,
                'welbonus' => 1000,
                'minrefwth' => 30000,
                'minactwth' => 30000,
                'minSocialWith' => 45,
                'spamt' => 200,
                'lovevault' => 500,
                
                
            ];
        case "plan_b":
            return [
                //  'refBonus' => 8.6,
                // 'indRefBonus' => 0.35,
                // 'secondIndRefBonus' => 0,
                'dailylogin' => 0,
                'welbonus' => 0,
                'minrefwth' => 0,
                'minactwth' => 0,
                'minSocialWith' => 0,
                'spamt' => 0,
            ];
        //  case "plan_c":
        //     return [
        //         //  'refBonus' => 8.6,
        //         // 'indRefBonus' => 0.35,
        //         // 'secondIndRefBonus' => 0,
        //         'welbonus' => 500,
        //         'minrefwth' => 25,
        //         'minactwth' => 1000,
        //         'minSocialWith' => 500,
        //         'spamt' => 100,
        //     ];    
        default:
            return [
                // 'refBonus' => 0,
                // 'indRefBonus' => 0,
                // 'secondIndRefBonus' => 0,
                'dailylogin' => 0,
                'welbonus' => 0,
                'minrefwth' => 0,
                'minactwth' => 0,
                'minSocialWith' => 0,
                'spamt' => 0,
            ];
    }


}


function getPlanReferralBonuses($acctPlan, $plantype) {
    // Determine the combined plan key
    $combinedPlan = $acctPlan . '_' . $plantype;

    // Use a switch statement to determine the bonuses based on the combined plan
switch ($combinedPlan) {
    case 'plan_a_plan_a':
        return [
            'refBonus' => 500,              // Referral bonus percentage for Plan A referring Plan A
            'indRefBonus' => 0,           // Indirect referral bonus percentage
            'secondIndRefBonus' => 0,        // Second-level indirect referral bonus percentage
        ];
        
         case 'plan_a_plan_b':
        case 'plan_b_plan_a':
            return [
                  'refBonus' => 0,              // Referral bonus percentage for Plan A referring Plan A
            'indRefBonus' => 0,           // Indirect referral bonus percentage
            'secondIndRefBonus' => 0,        // Second-level indirect referral bonus percentage
            ];
            
        
    case 'plan_b_plan_b':
        return [
            'refBonus' => 0,               // Referral bonus percentage for Plan B referring Plan B
            'indRefBonus' => 0,
            'secondIndRefBonus' => 0,
        ];

    default:
        return [
            'refBonus' => 0,
            'indRefBonus' => 0,
            'secondIndRefBonus' => 0,
        ];
}

}




//$sql=$link->prepare("SELECT * FROM earningstructure WHERE type='plan_a' ");
//$sql->execute();
//$result=$sql->get_result();
//$numrow=$result->num_rows;
//$row=$result->fetch_assoc();
//$dailyLoginA=$refBonusA=$welcomeBonusA=$minRefWithdrawAmtA=$minActWithdrawAmtA=$sponsoredPostAmtA=$taskAmtA=$minDataWithdrawAmtA=$indRefA=$thirdIndRefA="";
//if($numrow == 1){ 
//    $dailyLoginA=$row['dailylogin'];
//    $refBonusA=$row['refbonus'];
//    $indRefA=$row['indref'];
//    $thirdIndRefA=$row['thirdindref'];
//    $welcomeBonusA=$row['welbonus'];
//    $minRefWithdrawAmtA=$row['minrefwth'];
//    $minActWithdrawAmtA=$row['minactwth'];
//    $minDataWithdrawAmtA=$row['mindatawth'];
//    $sponsoredPostAmtA=$row['spamt'];
//    $taskAmtA=$row['taskamt'];
//}

//$sql=$link->prepare("SELECT * FROM earningstructure WHERE type='plan_b' ");
//$sql->execute();
//$result=$sql->get_result();
//$numrow=$result->num_rows;
//$row=$result->fetch_assoc();
//$dailyLoginB=$refBonusB=$welcomeBonusB=$minRefWithdrawAmtB=$minActWithdrawAmtB=$sponsoredPostAmtB=$taskAmtB=$minDataWithdrawAmtB=$indRefB=$thirdIndRefB="";
//if($numrow == 1){
//    $dailyLoginB=$row['dailylogin'];
//    $refBonusB=$row['refbonus'];
//    $indRefB=$row['indref'];
//    $thirdIndRefB=$row['thirdindref'];
//    $welcomeBonusB=$row['welbonus'];
//    $minRefWithdrawAmtB=$row['minrefwth'];
//    $minActWithdrawAmtB=$row['minactwth'];
//    $minDataWithdrawAmtB=$row['mindatawth'];
//    $sponsoredPostAmtB=$row['spamt'];
//    $taskAmtB=$row['taskamt'];
//}


//$sql=$link->prepare("SELECT * FROM earningstructure WHERE type='plan_c' ");
//$sql->execute();
//$result=$sql->get_result();
//$numrow=$result->num_rows;
//$row=$result->fetch_assoc();
//$dailyLoginC=$refBonusC=$welcomeBonusC=$minRefWithdrawAmtC=$minActWithdrawAmtC=$sponsoredPostAmtC=$taskAmtC=$minDataWithdrawAmtC=$indRefC=$thirdIndRefC="";
//if($numrow == 1){ 
//    $dailyLoginC=$row['dailylogin'];
//    $refBonusC=$row['refbonus'];
//    $indRefC=$row['indref'];
//    $thirdIndRefC=$row['thirdindref'];
//    $welcomeBonusC=$row['welbonus'];
//    $minRefWithdrawAmtC=$row['minrefwth'];
//    $minActWithdrawAmtC=$row['minactwth'];
//    $minDataWithdrawAmtC=$row['mindatawth'];
//    $sponsoredPostAmtC=$row['spamt'];
//    $taskAmtC=$row['taskamt'];
//}




//$sql=$link->prepare("SELECT * FROM earningstructure");
//$sql->execute();
//$result=$sql->get_result();
//$numrow=$result->num_rows;
//$row=$result->fetch_assoc();
//$dailyLogin=$refBonus=$welcomeBonus=$minRefWithdrawAmt=$minActWithdrawAmt=$taskAmt=$minDataWithdrawAmt=$cashBackData=$productDiscount="";
//if($numrow == 1){    
//    $refBonus=(int) $row['refbonus'];
//    $refDataBonus=(int) $row['refdatabonus'];
//    $indRef=(int) $row['indref'];
//    $thirdIndRef=(int) $row['thirdindref'];
//    $welcomeDataBonus=(int) $row['weldatabonus'];
//    $minRefWithdrawAmt=(int) $row['minrefwth'];
//    $minMainWithdrawAmt=(int) $row['minmainwth'];
//    $minDataWithdrawAmt=(int) $row['mindatawth'];
//    $couponAmount=(int) $row['couponamount'];
//    $minFunding=(int) $row['minfunding'];
//    $refDataComm=(int) $row['refdatacomm'];
//    $refAirtimeComm=(int) $row['refairtimecomm'];
//    $refCommFirstDeposit=(int) $row['refcommfirstdeposit'];
//    $cashBackData=(int) $row['cashbackdata'];
//    $productDiscount=(int) $row['productdiscount'];
//
//}

$sql=$link->prepare("SELECT * FROM dataprices");
$sql->execute();
$result=$sql->get_result();
$numrow=$result->num_rows;
$mtnSME500MB=$mtnSME1GB=$mtnSME2GB=$mtnSME5GB=$mtnSME10GB=$mtnCG500MB=$mtnCG1GB=$mtnCG2GB=$mtnCG5GB=$mtnCG10GB="";
$glo1_35GB=$glo2_90GB=$glo4_10GB=$glo5_80GB=$glo10GB="";
$airtel500MB=$airtel1GB=$airtel2GB=$airtel5GB=$airtel10GB="";
$etisalat500MB=$etisalat1_5GB=$etisalat2GB=$etisalat3GB=$etisalat11GB="";


if($numrow > 0){    
    while($row=$result->fetch_assoc()){
        $dataPLan=$row['dataplan'];
        $dataType=$row['datatype'];
        $network=$row['network'];
        $amount=$row['amount'];
        
        //=============MTN DATA PLANS

        if($dataPLan == "500MB" && $dataType == "sme" && $network == "mtn"){
            $mtnSME500MB=$amount;
        }
        else if($dataPLan == "1GB" && $dataType == "sme" && $network == "mtn"){
            $mtnSME1GB=$amount;
        }
        else if($dataPLan == "2GB" && $dataType == "sme" && $network == "mtn"){
            $mtnSME2GB=$amount;
        }
        else if($dataPLan == "5GB" && $dataType == "sme" && $network == "mtn"){
            $mtnSME5GB=$amount;
        }
        else if($dataPLan == "10GB" && $dataType == "sme" && $network == "mtn"){
            $mtnSME10GB=$amount;
        }
        else if($dataPLan == "500MB" && $dataType == "cg" && $network == "mtn"){
            $mtnCG500MB=$amount;
        }
        else if($dataPLan == "1GB" && $dataType == "cg" && $network == "mtn"){
            $mtnCG1GB=$amount;
        }
        else if($dataPLan == "2GB" && $dataType == "cg" && $network == "mtn"){
            $mtnCG2GB=$amount;
        }
        else if($dataPLan == "5GB" && $dataType == "cg" && $network == "mtn"){
            $mtnCG5GB=$amount;
        }
        else if($dataPLan == "10GB" && $dataType == "cg" && $network == "mtn"){
            $mtnCG10GB=$amount;
        }

        //=============GLO DATA PLANS

        if($dataPLan == "1.35GB" && $dataType == "direct" && $network == "glo"){
            $glo1_35GB=$amount;
        }
        else if($dataPLan == "2.90GB" && $dataType == "direct" && $network == "glo"){
            $glo2_90GB=$amount;
        }
        else if($dataPLan == "4.10GB" && $dataType == "direct" && $network == "glo"){
            $glo4_10GB=$amount;
        }
        else if($dataPLan == "5.80GB" && $dataType == "direct" && $network == "glo"){
            $glo5_80GB=$amount;
        }
        else if($dataPLan == "10GB" && $dataType == "direct" && $network == "glo"){
            $glo10GB=$amount;
        }

        //=============AIRTEL DATA PLANS

        if($dataPLan == "500MB" && $dataType == "cg" && $network == "airtel"){
            $airtel500MB=$amount;
        }
        else if($dataPLan == "1GB" && $dataType == "cg" && $network == "airtel"){
            $airtel1GB=$amount;
        }
        else if($dataPLan == "2GB" && $dataType == "cg" && $network == "airtel"){
            $airtel2GB=$amount;
        }
        else if($dataPLan == "5GB" && $dataType == "cg" && $network == "airtel"){
            $airtel5GB=$amount;
        }
        else if($dataPLan == "10GB" && $dataType == "cg" && $network == "airtel"){
            $airtel10GB=$amount;
        }

        //=============9MOBILE DATA PLANS

        if($dataPLan == "500MB" && $dataType == "direct" && $network == "9mobile"){
            $etisalat500MB=$amount;
        }
        else if($dataPLan == "1.5GB" && $dataType == "direct" && $network == "9mobile"){
            $etisalat1_5GB=$amount;
        }
        else if($dataPLan == "2GB" && $dataType == "direct" && $network == "9mobile"){
            $etisalat2GB=$amount;
        }
        else if($dataPLan == "3GB" && $dataType == "direct" && $network == "9mobile"){
            $etisalat3GB=$amount;
        }
        else if($dataPLan == "11GB" && $dataType == "direct" && $network == "9mobile"){
            $etisalat11GB=$amount;
        }

    }
}


$sql=$link->prepare("SELECT * FROM airtimeprices");
$sql->execute();
$result=$sql->get_result();
$numrow=$result->num_rows;
$airtimeDiscountMtn=$airtimeDiscountAirtel=$airtimeDiscountGlo=$airtimeDiscount9Mobile="";

if($numrow > 0){    
    while($row=$result->fetch_assoc()){
        $network=$row['network'];
        $discount=$row['discount'];
        if($network == "mtn"){
            $airtimeDiscountMtn=$discount;
        }
        else if($network == "glo"){
            $airtimeDiscountGlo=$discount;
        }
        else if($network == "airtel"){
            $airtimeDiscountAirtel=$discount;
        }
        else if($network == "9mobile"){
            $airtimeDiscount9Mobile=$discount;
        }

    }
}


$sql=$link->prepare("SELECT * FROM cableprices");
$sql->execute();
$result=$sql->get_result();
$numrow=$result->num_rows;
$gotvSmallie=$gotvSmallieQ=$gotvSmallieY=$gotvJolli=$gotvJinja=$gotvMax=$gotvSupa="";
$startimesNova=$startimesBasic=$startimesSmart=$startimesClassic=$startimesSuper="";
$dstvPadi=$dstvYanga=$dstvConfam=$dstvCompact=$dstvCompactPlus=$dstvPremium=$dstvPadiExtraView="";


if($numrow > 0){    
    while($row=$result->fetch_assoc()){
        $plan=$row['plan'];
        $cable=$row['cable'];
        $amount=$row['amount'];
        
        //=============GOTV PLANS

        if($plan == "gotv smallie" && $cable == "gotv"){
            $gotvSmallie=$amount;
        }
        else if($plan == "gotv smallie quaterly" && $cable == "gotv"){
            $gotvSmallieQ=$amount;
        }
        else if($plan == "gotv smallie yearly" && $cable == "gotv"){
            $gotvSmallieY=$amount;
        }
        else if($plan == "gotv jolli" && $cable == "gotv"){
            $gotvJolli=$amount;
        }
        else if($plan == "gotv jinja" && $cable == "gotv"){
            $gotvJinja=$amount;
        }
        else if($plan == "gotv max" && $cable == "gotv"){
            $gotvMax=$amount;
        }
        else if($plan == "gotv supa" && $cable == "gotv"){
            $gotvSupa=$amount;
        }

        //=============STARTIMES PLANS

        if($plan == "startimes nova" && $cable == "startimes"){
            $startimesNova=$amount;
        }
        else if($plan == "startimes basic" && $cable == "startimes"){
            $startimesBasic=$amount;
        }
        else if($plan == "startimes smart" && $cable == "startimes"){
            $startimesSmart=$amount;
        }
        else if($plan == "startimes classic" && $cable == "startimes"){
            $startimesClassic=$amount;
        }
        else if($plan == "startimes super" && $cable == "startimes"){
            $startimesSuper=$amount;
        }

        //=============DSTV PLANS

        if($plan == "dstv padi" && $cable == "dstv"){
            $dstvPadi=$amount;
        }
        else if($plan == "dstv yanga" && $cable == "dstv"){
            $dstvYanga=$amount;
        }
        else if($plan == "dstv confam" && $cable == "dstv"){
            $dstvConfam=$amount;
        }
        else if($plan == "dstv compact" && $cable == "dstv"){
            $dstvCompact=$amount;
        }
        else if($plan == "dstv compact plus" && $cable == "dstv"){
            $dstvCompactPlus=$amount;
        }
        else if($plan == "dstv premium" && $cable == "dstv"){
            $dstvPremium=$amount;
        }
        else if($plan == "dstv padi + extraview" && $cable == "dstv"){
            $dstvPadiExtraView=$amount;
        }

    }
}
?>



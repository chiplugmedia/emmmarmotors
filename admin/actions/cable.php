<?php
$genMsg="";
if(isset($_POST['addGotv'])){

    if(validateInput()){
        $cable1=$gotvSmallie=filter_string($_POST['cable1']);
        $cable2=$gotvSmallieQ=filter_string($_POST['cable2']);
        $cable3=$gotvSmallieY=filter_string($_POST['cable3']);
        $cable4=$gotvJolli=filter_string($_POST['cable4']);
        $cable5=$gotvJinja=filter_string($_POST['cable5']);
        $cable6=$gotvMax=filter_string($_POST['cable6']);
        $cable7=$gotvSupa=filter_string($_POST['cable7']);

        $cableType="gotv";
        $data=array(
            array(
                "plan" => "gotv smallie", 
                "serviceID" => 610, 
                "amount" => $cable1
            ), 
            array(
                "plan" => "gotv smallie quaterly", 
                "serviceID" => 614, 
                "amount" => $cable2
            ), 
            array(
                "plan" => "gotv smallie yearly", 
                "serviceID" => 615, 
                "amount" => $cable3
            ), 
            array(
                "plan" => "gotv jolli", 
                "serviceID" => 612, 
                "amount" => $cable4
            ),
            array(
                "plan" => "gotv jinja", 
                "serviceID" => 613, 
                "amount" => $cable5
            ), 
            array(
                "plan" => "gotv max", 
                "serviceID" => 611, 
                "amount" => $cable6
            ), 
            array(
                "plan" => "gotv supa", 
                "serviceID" => 616, 
                "amount" => $cable7
            )
        );
        $genMsg=updatecablePrices($cableType, $data);
        
    }
    else{
        $status="error";
        $message="Amount for one or more field is required";
        $genMsg=sendResponse($status, $message);
    }
}



if(isset($_POST['addStartimes'])){
    if(validateInput()){
        $cable1=$startimesNova=filter_string($_POST['cable1']);
        $cable2=$startimesBasic=filter_string($_POST['cable2']);
        $cable3=$startimesSmart=filter_string($_POST['cable3']);
        $cable4=$startimesClassic=filter_string($_POST['cable4']);
        $cable5=$startimesSuper=filter_string($_POST['cable5']);

        $cableType="startimes";
        $data=array(
            array(
                "plan" => "startimes nova", 
                "serviceID" => 710, 
                "amount" => $cable1
            ), 
            array(
                "plan" => "startimes basic", 
                "serviceID" => 711, 
                "amount" => $cable2
            ), 
            array(
                "plan" => "startimes smart", 
                "serviceID" => 712, 
                "amount" => $cable3
            ), 
            array(
                "plan" => "startimes classic", 
                "serviceID" => 713, 
                "amount" => $cable4
            ),
            array(
                "plan" => "startimes super", 
                "serviceID" => 715, 
                "amount" => $cable5
            )
        );
        $genMsg=updatecablePrices($cableType, $data);
        
    }
    else{
        $status="error";
        $message="Amount for one or more field is required";
        $genMsg=sendResponse($status, $message);
    }
}


if(isset($_POST['addDstv'])){

    if(validateInput()){
        $cable1=$dstvPadi=filter_string($_POST['cable1']);
        $cable2=$dstvYanga=filter_string($_POST['cable2']);
        $cable3=$dstvConfam=filter_string($_POST['cable3']);
        $cable4=$dstvCompact=filter_string($_POST['cable4']);
        $cable5=$dstvCompactPlus=filter_string($_POST['cable5']);
        $cable6=$dstvPremium=filter_string($_POST['cable6']);
        $cable7=$dstvPadiExtraView=filter_string($_POST['cable7']);

        $cableType="dstv";
        $data=array(
            array(
                "plan" => "dstv padi", 
                "serviceID" => 510, 
                "amount" => $cable1
            ), 
            array(
                "plan" => "dstv yanga", 
                "serviceID" => 511, 
                "amount" => $cable2
            ), 
            array(
                "plan" => "dstv confam", 
                "serviceID" => 512, 
                "amount" => $cable3
            ), 
            array(
                "plan" => "dstv compact", 
                "serviceID" => 513, 
                "amount" => $cable4
            ),
            array(
                "plan" => "dstv compact plus", 
                "serviceID" => 514, 
                "amount" => $cable5
            ), 
            array(
                "plan" => "dstv premium", 
                "serviceID" => 515, 
                "amount" => $cable6
            ), 
            array(
                "plan" => "dstv padi + extraview", 
                "serviceID" => 516, 
                "amount" => $cable7
            )
        );
        $genMsg=updatecablePrices($cableType, $data);
        
    }
    else{
        $status="error";
        $message="Amount for one or more field is required";
        $genMsg=sendResponse($status, $message);
    }
 }

function validateInput(){

    $count=0;
    $totalCount=count($_POST);
    foreach($_POST as $key => $value){
        if($_POST[$key] == ""){
            break;
        }
        else {
            $count++;
        }
    }

    if($count == $totalCount){
        $response=true;
    }
    else{
        $response=false;
    }
    return $response;
}

function updatecablePrices($cableType, $datas){
    global $link, $dateTime;

    $sql=$link->prepare("SELECT * FROM cableprices WHERE cable=? ");
    $sql->bind_param("s", $cableType);
    $sql->execute();
    $result=$sql->get_result();
    $numrow=$result->num_rows;

    if($numrow == 0){
        $sql=$link->prepare("INSERT cableprices(cable, plan, amount, serviceid, date) VALUES(?,?,?,?,?)");
        $sql->bind_param("sssss", $cableType, $plan, $amount, $serviceID, $dateTime);
    }
    else{
        $sql=$link->prepare("UPDATE cableprices SET amount=? WHERE plan=? AND cable=?");
        $sql->bind_param("sss", $amount, $plan, $cableType);
    }
    foreach($datas as $key => $cable){
        $plan=$datas[$key]['plan'];
        $amount=$datas[$key]['amount'];
        $serviceID=$datas[$key]['serviceID'];
        $sql->execute();
    }

    $status="success";
    $message=strtoupper($cableType)." Prices updated";

    return sendResponse($status, $message);
}
?>
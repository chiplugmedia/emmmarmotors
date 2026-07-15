<?php
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/app/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/topup.php";


if(isset($_POST['cablePlan']) && !empty($_POST['cablePlan'])){
    $cables=array("gotv","dstv","startimes");
    if(empty($_POST['cable'])){
        $status="error";
        $message="Select cable";
        // echo sendResponse($status, $message);
    }
    else if(!in_array($_POST['cable'], $cables)){
        $status="error";
        $message="Invalid cable";
        // echo sendResponse($status, $message);
    }
    else{
        $cable=filter_string($_POST['cable']);
        $sql=$link->prepare("SELECT * FROM cableprices WHERE cable=?");
        $sql->bind_param("s", $cable);
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;
        if($numrow > 0){

        ?>
        <option value="" disabled selected>Select data plan</option>
        <?php
            while($row=$result->fetch_assoc()){
                $amount=$row['amount'];
                $cablePlan=$row['plan'];
                $serviceID=$row['serviceid'];
                $cablePlan=strtoupper($cablePlan);
                $amount=number_format($amount, 2);
        ?>
        <option value="<?php echo $serviceID?>"><?php echo "$cablePlan ₦$amount"?></option>
        <?php } }else { ?>
        <option value="" disabled selected>No cable plan found</option>
        <?php
        }
    }
}
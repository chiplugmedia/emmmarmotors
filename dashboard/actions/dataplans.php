<?php
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/dash/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/topup.php";


if(isset($_POST['dataPlan']) && !empty($_POST['dataPlan'])){
    $networks=array("mtn","airtel","9mobile","glo");
    if(empty($_POST['network'])){
        $status="error";
        $message="Select network";
         echo sendResponse($status, $message);
    }
    else if(!in_array($_POST['network'], $networks)){
        $status="error";
        $message="Invalid network";
         echo sendResponse($status, $message);
    }
    else{
        $network=filter_string($_POST['network']);
        if(isset($_POST['autoData']) && $_POST['network'] == "mtn"){
            $sql=$link->prepare("SELECT * FROM dataprices WHERE network='mtn' AND datatype='sme' ");
        }
        else{
            $sql=$link->prepare("SELECT * FROM dataprices WHERE network=?");
            $sql->bind_param("s", $network);
        }
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;
        if($numrow > 0){

        ?>
        <option value="" disabled selected>Select data plan</option>
        <?php
            while($row=$result->fetch_assoc()){
                $amount=$row['amount'];
                $dataPlan=$row['dataplan'];
                $dataType=$row['datatype'];
                $serviceID=$row['serviceid'];
                $network=strtoupper($network);
                $amount=number_format($amount, 2);
                
                if(isset($_POST['autoData'])){
                    $amount="";
                }
                else{
                    $amount="₦$amount";
                }
        ?>
        <option value="<?php echo $serviceID?>"><?php echo "$network $dataPlan $amount ($dataType)"?></option>
        <?php } }else { ?>
        <option value="" disabled selected>No data plan found</option>
        <?php
        }
    }
}
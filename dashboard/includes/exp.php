<?php

$remain=time() - $expirationTime;

$date1 =new DateTime(date("d-m-Y", $expirationTime));
$date2 =new DateTime(date("d-m-Y", time()));
$dateDiff=$date1->diff($date2);
        
$remainingDays=$dateDiff->days;
if($remainingDays == 0){
    $acctType="free";
    $accountStatus= "expired";
    $sql=$link->prepare("UPDATE users SET acctype='free', status='expired', plantype='' WHERE username=?");
    $sql->bind_param("s", $username);
    $sql->execute();
}

?>
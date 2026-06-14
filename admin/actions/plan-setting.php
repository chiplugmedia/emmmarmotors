<?php 
$genMsg="";

if(isset($_POST['savePlanA'])){
    if($_POST['dailyLogina'] !=""){
        $dailyLoginA=$_POST['dailyLogina'];
    }
    if($_POST['refBonusa'] !=""){
        $refBonusA=$_POST['refBonusa'];
    }
    if($_POST['welBonusa'] !=""){
        $welcomeBonusA=$_POST['welBonusa'];
    }
    if($_POST['minRefWithdrawAmta'] !=""){
        $minRefWithdrawAmtA=$_POST['minRefWithdrawAmta'];
    }
    if($_POST['minActWithdrawAmta'] !=""){
        $minActWithdrawAmtA=$_POST['minActWithdrawAmta'];
    }
    if($_POST['spAmta'] !=""){
        $sponsoredPostAmtA=$_POST['spAmta'];
    }
    if($_POST['indRefa'] !=""){
        $indRefA=$_POST['indRefa'];
    }
    if($_POST['thirdIndRefa'] !=""){
        $thirdIndRefA=$_POST['thirdIndRefa'];
    }
    
    if($_POST['dailyLogina'] ==""){
        $status="error";
        $message="Enter daily logina"; 
        $genMsg=sendResponse($status, $message);
    }
    
    else if($_POST['refBonusa'] ==""){
        $status="error";
        $message="Enter referral amount"; 
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['welBonusa'] ==""){
        $status="error";
        $message="Enter acct welcome bonus"; 
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['minRefWithdrawAmta'] ==""){
        $status="error";
        $message="Enter minimum referral wallet withdrawal amount";
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['minActWithdrawAmta'] ==""){
        $status="error";
        $message="Enter minimum act wallet withdrawal amount";
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['spAmta'] ==""){
        $status="error";
        $message="Enter sponsored post amount";
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['indRefa'] ==""){
        $status="error";
        $message="Enter indirect bonus"; 
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['thirdIndRefa'] ==""){
        $status="error";
        $message="Enter third indirect bonus"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $dailyLoginA=filter_string($_POST['dailyLogina']);
        $refBonusA=filter_string($_POST['refBonusa']);
        $welcomeBonusA=filter_string($_POST['welBonusa']);
        $minRefWithdrawAmtA=filter_string($_POST['minRefWithdrawAmta']);
        $minActWithdrawAmtA=filter_string($_POST['minActWithdrawAmta']);
        $sponsoredPostAmtA=filter_string($_POST['spAmta']);
        $indRefA=filter_string($_POST['indRefa']);
        $thirdIndRefA=filter_string($_POST['thirdIndRefa']);

        $sql=$link->prepare("SELECT * FROM earningstructure WHERE type='plan_a' ");
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;
        $type="plan_a";
        if($numrow == 0){
            $sql=$link->prepare("INSERT INTO earningstructure(dailylogin, refbonus, welbonus, minrefwth, minactwth, spamt, indref, thirdindref, type, date) VALUES(?,?,?,?,?,?,?,?,?,?)");
        }
        else{
            $sql=$link->prepare("UPDATE earningstructure SET dailylogin=?, refbonus=?, welbonus=?, minrefwth=?, minactwth=?, spamt=?, indref=?, thirdindref=?, date=? WHERE type=?");
        }
        $sql->bind_param("ssssssssss", $dailyLoginA, $refBonusA, $welcomeBonusA, $minRefWithdrawAmtA, $minActWithdrawAmtA, $sponsoredPostAmtA, $indRefA, $thirdIndRefA, $dateTime, $type);
        
        if($sql->execute()){
            $status="success";
            $message="$type Earnings has been updated";
            $genMsg=sendResponse($status, $message);
            
        }
        else{
            $status="error";
            $message="Something went wrong";
            $genMsg=sendResponse($status, $message);
        }
    }
}

if(isset($_POST['savePlanB'])){
    if($_POST['dailyLoginb'] !=""){
        $dailyLoginB=$_POST['dailyLoginb'];
    }
    if($_POST['refBonusb'] !=""){
        $refBonusB=$_POST['refBonusb'];
    }
    if($_POST['welBonusb'] !=""){
        $welcomeBonusB=$_POST['welBonusb'];
    }
    if($_POST['minRefWithdrawAmtb'] !=""){
        $minRefWithdrawAmtB=$_POST['minRefWithdrawAmtb'];
    }
    if($_POST['minActWithdrawAmtb'] !=""){
        $minActWithdrawAmtB=$_POST['minActWithdrawAmtb'];
    }
    if($_POST['spAmtb'] !=""){
        $sponsoredPostAmtB=$_POST['spAmtb'];
    }
    if($_POST['indRefb'] !=""){
        $indRefB=$_POST['indRefb'];
    }
    if($_POST['thirdIndRefb'] !=""){
        $thirdIndRefB=$_POST['thirdIndRefb'];
    }
    
    if($_POST['dailyLoginb'] ==""){
        $status="error";
        $message="Enter daily login"; 
        $genMsg=sendResponse($status, $message);
    }
    
    else if($_POST['refBonusb'] ==""){
        $status="error";
        $message="Enter referral amount"; 
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['welBonusb'] ==""){
        $status="error";
        $message="Enter acct welcome bonus"; 
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['minRefWithdrawAmtb'] ==""){
        $status="error";
        $message="Enter minimum referral wallet withdrawal amount";
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['minActWithdrawAmtb'] ==""){
        $status="error";
        $message="Enter minimum act wallet withdrawal amount";
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['spAmtb'] ==""){
        $status="error";
        $message="Enter sponsored post amount";
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['indRefb'] ==""){
        $status="error";
        $message="Enter indirect bonus"; 
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['thirdIndRefb'] ==""){
        $status="error";
        $message="Enter third indirect bonus"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $dailyLoginB=filter_string($_POST['dailyLoginb']);
        $refBonusB=filter_string($_POST['refBonusb']);
        $welcomeBonusB=filter_string($_POST['welBonusb']);
        $minRefWithdrawAmtB=filter_string($_POST['minRefWithdrawAmtb']);
        $minActWithdrawAmtB=filter_string($_POST['minActWithdrawAmtb']);
        $sponsoredPostAmtB=filter_string($_POST['spAmtb']);
        $indRefB=filter_string($_POST['indRefb']);
        $thirdIndRefB=filter_string($_POST['thirdIndRefb']);

        $sql=$link->prepare("SELECT * FROM earningstructure WHERE type='plan_b'");
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;
        $type="plan_b";
        if($numrow == 0){
            $sql=$link->prepare("INSERT INTO earningstructure(dailylogin, refbonus, welbonus, minrefwth, minactwth, spamt, indref, thirdindref, type, date) VALUES(?,?,?,?,?,?,?,?,?,?)");
        }
        else{
            $sql=$link->prepare("UPDATE earningstructure SET dailylogin=?, refbonus=?, welbonus=?, minrefwth=?, minactwth=?, spamt=?, indref=?, thirdindref=?, date=? WHERE type=?");
        }
        $sql->bind_param("ssssssssss", $dailyLoginB, $refBonusB, $welcomeBonusB, $minRefWithdrawAmtB, $minActWithdrawAmtB, $sponsoredPostAmtB, $indRefB, $thirdIndRefB, $dateTime, $type);
        
        if($sql->execute()){
            $status="success";
            $message="$type Earnings has been updated";
            $genMsg=sendResponse($status, $message);
            
        }
        else{
            $status="error";
            $message="Something went wrong";
            $genMsg=sendResponse($status, $message);
        }
    }
}

if(isset($_POST['savePlanC'])){
    if($_POST['dailyLoginc'] !=""){
        $dailyLoginC=$_POST['dailyLoginc'];
    }
    if($_POST['refBonusc'] !=""){
        $refBonusC=$_POST['refBonusc'];
    }
    if($_POST['welBonusc'] !=""){
        $welcomeBonusC=$_POST['welBonusc'];
    }
    if($_POST['minRefWithdrawAmtc'] !=""){
        $minRefWithdrawAmtC=$_POST['minRefWithdrawAmtc'];
    }
    if($_POST['minActWithdrawAmtc'] !=""){
        $minActWithdrawAmtC=$_POST['minActWithdrawAmtc'];
    }
    if($_POST['spAmtc'] !=""){
        $sponsoredPostAmtC=$_POST['spAmtc'];
    }
    if($_POST['indRefc'] !=""){
        $indRefC=$_POST['indRefc'];
    }
    if($_POST['thirdIndRefc'] !=""){
        $thirdIndRefC=$_POST['thirdIndRefc'];
    }
    
    if($_POST['dailyLoginc'] ==""){
        $status="error";
        $message="Enter daily login"; 
        $genMsg=sendResponse($status, $message);
    }
    
    else if($_POST['refBonusc'] ==""){
        $status="error";
        $message="Enter referral amount"; 
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['welBonusc'] ==""){
        $status="error";
        $message="Enter acct welcome bonus"; 
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['minRefWithdrawAmtc'] ==""){
        $status="error";
        $message="Enter minimum referral wallet withdrawal amount";
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['minActWithdrawAmtc'] ==""){
        $status="error";
        $message="Enter minimum act wallet withdrawal amount";
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['spAmtc'] ==""){
        $status="error";
        $message="Enter sponsored post amount";
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['indRefc'] ==""){
        $status="error";
        $message="Enter indirect bonus"; 
        $genMsg=sendResponse($status, $message);
    }
    else if($_POST['thirdIndRefc'] ==""){
        $status="error";
        $message="Enter third indirect bonus"; 
        $genMsg=sendResponse($status, $message);
    }
    else{
        $dailyLoginC=filter_string($_POST['dailyLoginc']);
        $refBonusC=filter_string($_POST['refBonusc']);
        $welcomeBonusC=filter_string($_POST['welBonusc']);
        $minRefWithdrawAmtC=filter_string($_POST['minRefWithdrawAmtc']);
        $minActWithdrawAmtC=filter_string($_POST['minActWithdrawAmtc']);
        $sponsoredPostAmtC=filter_string($_POST['spAmtc']);
        $indRefC=filter_string($_POST['indRefc']);
        $thirdIndRefC=filter_string($_POST['thirdIndRefc']);

        $sql=$link->prepare("SELECT * FROM earningstructure WHERE type='plan_c'");
        $sql->execute();
        $result=$sql->get_result();
        $numrow=$result->num_rows;
        $type="plan_c";
        if($numrow == 0){
            $sql=$link->prepare("INSERT INTO earningstructure(dailylogin, refbonus, welbonus, minrefwth, minactwth, spamt, indref, thirdindref, type, date) VALUES(?,?,?,?,?,?,?,?,?,?)");
        }
        else{
            $sql=$link->prepare("UPDATE earningstructure SET dailylogin=?, refbonus=?, welbonus=?, minrefwth=?, minactwth=?, spamt=?, indref=?, thirdindref=?, date=? WHERE type=?");
        }
        $sql->bind_param("ssssssssss", $dailyLoginC, $refBonusC, $welcomeBonusC, $minRefWithdrawAmtC, $minActWithdrawAmtC, $sponsoredPostAmtC, $indRefC, $thirdIndRefC, $dateTime, $type);
        
        if($sql->execute()){
            $status="success";
            $message="$type Earnings has been updated";
            $genMsg=sendResponse($status, $message);
            
        }
        else{
            $status="error";
            $message="Something went wrong";
            $genMsg=sendResponse($status, $message);
        }
    }
}

?>
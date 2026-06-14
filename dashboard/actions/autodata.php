<?php
require $_SERVER['DOCUMENT_ROOT']."/stream.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/includes/generalinclude.php";
require $_SERVER['DOCUMENT_ROOT']."$stream/app/includes/generalinclude.php";
$genMsg="";
if(isset($_POST['autoData']) && !empty($_POST['autoData'])){
   require $_SERVER['DOCUMENT_ROOT']."$stream/includes/topup.php";
    $networks=array("mtn", "airtel");
   if(empty($_POST['serviceID'])){
        $status="error";
        $message="Select dataplan";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['network'])){
        $status="error";
        $message="Select network";
        $genMsg=sendResponse($status, $message);
    }
    else if(!in_array($_POST['network'], $networks)){
        $status="error";
        $message="Invalid network";
        $genMsg=sendResponse($status, $message);
    }
    else if(empty($_POST['phone'])){
        $status="error";
        $message="Enter phone number";
        $genMsg=sendResponse($status, $message);
    }
    else if(strlen($_POST['phone'])  != 11){
        $status="error";
        $message="Invalid phone number";
        $genMsg=sendResponse($status, $message);
    }
    else{
        $serviceID=filter_string($_POST['serviceID']);
        $network=filter_string($_POST['network']);
        $phone=filter_string($_POST['phone']);
        if($serviceID == 10 || $serviceID == 25){
            $amount=500;
            $dataPlan="500MB";
        }
        else if($serviceID == 11 || $serviceID == 26){
            $amount=1000;
            $dataPlan="1GB";
        }
        else if($serviceID == 12 || $serviceID == 27){
            $amount=2000;
            $dataPlan="2GB";
        }
        else if($serviceID == 13){
            $amount=3000;
            $dataPlan="3GB";
        }
        else if($serviceID == 14 || $serviceID == 28){
            $amount=5000;
            $dataPlan="5GB";
        }
        else if($serviceID == 15 || $serviceID == 29){
            $amount=10000;
            $dataPlan="10GB";
        }
        else{
            $amount=false;
        }
        
        if(!$amount){
            $status="error";
            $message="Invalid data plan";
            $genMsg=sendResponse($status, $message);
        }
        else{
            $reference=get_rand_alphanumeric(20);
            
           if($amount > $dataFunds){
                $status="error";
                $message="Insufficent data";
                $genMsg=sendResponse($status, $message);
            }
            // else if(!$dataWithdraw){
            //     $status="error";
            //     $message="Withdrawal is currently not avaliable";
            //     $genMsg=sendResponse($status, $message);
            // }
           // else{
               // $sql=$link->prepare("SELECT * FROM withdrawals WHERE username=? AND status='pending' AND type='data_withdraw' ");
               // $sql->bind_param("s", $username);
               // $sql->execute();
               // $result=$sql->get_result();
                //$numrow_wth=$result->num_rows;
    
              //  if($numrow_wth > 0){
                //    $status="error";
              //      $message="You have a pending data withdrawal already";
               //     $genMsg=sendResponse($status, $message);
               // }
                else{
                    $data=array("mobileNumber" => $phone);
                //   $validateMobile=validateMobile($data);
                //   $status=$validateMobile['status'];
                //   $validateMsg=$validateMobile['message'];
                   $status="success"; 
                   if($status == "success"){
                    //   $network=strtolower($validateMobile['data']['operator']);
                       if($network == "mtn"){
                           $sql=$link->prepare("UPDATE users SET datafunds=datafunds - ? WHERE username=?");
                           $sql->bind_param("ss", $amount, $username);
                           $sql->execute();
                           
                           $status="pending";
                           $type=$wallet="data";
                           $sql=$link->prepare("INSERT INTO withdrawals(username, type, amount, wallet, description, number, network, status, reference, date) VALUES(?,?,?,?,?,?,?,?,?,?)");
                           $sql->bind_param("ssssssssss", $username, $type, $amount,  $wallet, $phone, $phone, $network, $status, $reference, $dateTime);
                           $sql->execute();
                           
                          $data=array("serviceID" => $serviceID, "phone" => $phone, "reference" =>$reference);
                          $buyData=buyData($data);
                          $status=$buyData['status'];
                          $dataMessage=$buyData['message'];
                          //$status="success" ;
                          //$dataMessage=true;
                        
                           if($status == "success"){
                           	//$dataPlan=$apiAmount=$apiReference=100;
                              $dataPlan=$buyData['data']['dataPlan'];
                              $apiAmount=$buyData['data']['amount'];
                              $apiReference=(isset($buyData['data']['reference'])) ? $buyData['data']['reference'] : "";
                              $dataStatus="success";
                        
    
                                $sql=$link->prepare("UPDATE withdrawals SET status=? WHERE reference=?");
                                $sql->bind_param("ss", $dataStatus, $reference);
                                if($sql->execute()){
                                    $dataFunds -= $amount;
                                    $status="success";
                                    $message="$dataPlan sent to $phone successfully";
                                    $genMsg=sendResponse($status, $message);
                
                                }
                                else{
                                    $status="error";
                                    $message="Something went wrong";
                                    $genMsg=sendResponse($status, $message);
                                }
                          }
                          else{
                              if($dataMessage == "Data purchase failed. Service is temporarily unavailable"){
                                  $sql=$link->prepare("UPDATE users SET datafunds=datafunds + ? WHERE username=?");
                                  $sql->bind_param("ss", $amount, $username);
                                  $sql->execute();
                                  $dataFunds += $amount;

                              }
                              
                              $dataStatus="failed";
                              
                              $sql=$link->prepare("UPDATE withdrawals SET status=? WHERE reference=?");
                              $sql->bind_param("ss", $dataStatus, $reference);
                              $sql->execute();
                              
                              $status="error";
                              $message="Data purchase failed";
                              $genMsg=sendResponse($status, $message);
                          }
                        
                        $network="MTN";
                        $sql=$link->prepare("INSERT INTO datawithdrawals(username, dataplan, amount, status, message, reference, serviceid, phone, network, apireference, date) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
                        $sql->bind_param("sssssssssss", $username, $dataPlan, $apiAmount, $dataStatus, $dataMessage, $reference, $serviceID, $phone, $network, $apiReference, $dateTime);
                        $sql->execute();
                           
                       }
                       else{
                            $status="error";
                            $message="You are not sending to a valid MTN number";
                            $genMsg=sendResponse($status, $message);
                       }
                      
                   }
                   else{
                        $status="error";
                        $message="Mobile number validation failed.";
                        $genMsg=sendResponse($status, $message);
                   }
            }
        }
    }
    echo $genMsg;
    exit;
}

?>
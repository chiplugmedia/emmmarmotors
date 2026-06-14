<?php 
if(!isset($_SESSION['username']) || $_SESSION['role'] != "admin"){
	header("location:$stream/login.php");
	exit;
}
if(isset($_SESSION['username'])){
    $username=filter_string($_SESSION['username']) ;
	$sql=$link->prepare("SELECT * FROM users WHERE username=? AND role='admin' ") ;
	$sql->bind_param('s', $username) ;
	$sql->execute() ;
	$result=$sql->get_result() ;
	$numRows=$result->num_rows ;
	
	if($numRows == 0){
        header("location:$stream/login.php");
        exit;
	}
	else {
		$row=$result->fetch_assoc() ;
		
		$email=$row['email'];
		$fullname=$row['fullname'];
		$fname=explode(" ", $fullname);
		$firstname=ucwords($fname[0]);
		$lastname="";
        if(isset($fname[1])){
            $lastname=ucwords($fname[1]);
        }
		$phoneNumber=$row['phone'] ;
		$hashedPassword=$row['password'] ;

	}
} 
else{
    header("location:$stream/login.php");
    exit;
}
 
?>
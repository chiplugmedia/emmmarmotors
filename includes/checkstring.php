<?php
function filter_string($string){
	$string=trim($string) ;
	$string=stripcslashes($string) ;
	$string=htmlspecialchars($string) ;
	
	return $string ;
} 
?>
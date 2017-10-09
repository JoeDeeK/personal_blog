<?php
	function Redirect_to($New_Location){
		header("Location:".$New_Location);
			exit;
	}
	
	function Login_Attempt($Username, $Password){
		$ConnectingDB; 
		$Connection; 
		$Query="SELECT * FROM registration WHERE username = '$Username' AND password = '$Password'";
		
		$Execute=mysql_query($Query);
		
		if($Admin=mysql_fetch_assoc($Execute)){ 
			return $Admin;
		}else{
			return null;
		}
	}
?>
<?php
	function Redirect_to($New_Location){
		header("Location:".$New_Location);
			exit;
	}
	
	function Login_Attempt($Username, $Password){
		$ConnectingDB; //$ConnectingDB is reconized from DB.php
		$Connection; //Added to try, still login not accepted
		$Query="SELECT * FROM registration WHERE username = '$Username' AND password = '$Password'";
		//$Execute=mysqli_query($Connection, $Query);//$Connection not reconized from DB.php, passing null
		$Execute=mysql_query($Query);//$Connection not reconized from DB.php, passing null
		//if($Admin=mysqli_fetch_assoc($Execute)){ //received null
		if($Admin=mysql_fetch_assoc($Execute)){ //received null
			return $Admin; //returned null
		}else{
			return null;
		}
	}

	//Can probably remove the login checks if decide not to use them
	function Login(){
		if(isset($_SESSION["User_Id"])){
			return true;
		}
	}

	function Confirm_Login(){
		if(!Login()){
			$_SESSION["ErrorMessage"]="Login Required!";
			//Redirect_to("login.php"); //Dash = false; && redirect to login page OR blog site
		}
	}
?>
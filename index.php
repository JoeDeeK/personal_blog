<?php 
	include('includes/header.php');
?>

<?php 	
	if($Dash){ 
		if($_SESSION['User_Name']){
			include('includes/dashboard.php');
		}else{
			include('includes/login.php');
		}		
	}else{
		include('includes/navbar.php');
		include('includes/blog.php');
	}
?>

<?php
	include('includes/footer.php');
?>
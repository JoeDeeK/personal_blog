<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php 	
	$_SESSION["User_Id"]=null;
	$_SESSION["User_Name"]=null;
	session_destroy();
	Redirect_to("index.php?Dash=false");
?> 
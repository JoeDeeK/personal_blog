<?php require_once("includes/database.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
 
<?php
	$Dash; 
	$ViewQuery;

	if(isset($_GET['Dash'])){
		if($_GET['Dash']){
			$Dash = true;
		}else{
			$Dash = false;
		}
	}
	
	if(isset($_GET['Logout'])){
		if($_GET['Logout']){
			$_SESSION["User_Id"]=null;
			$_SESSION["User_Name"]=null;
			session_destroy();
			Redirect_to("index.php?Page=1");
		}		
	}
	
	if(isset($_GET["ApproveComment"])){
		$IdFromURL=$_GET["ApproveComment"];
		//$ConnectingDB;
		$Admin=$_SESSION["Username"];
		$Query="UPDATE comments SET status='ON', approvedby='$Admin' WHERE id='$IdFromURL'";
		
		$Execute=mysql_query($Query);
		if($Execute){
			$_SESSION["SuccessMessage"]="Comment Approved Successfully";	
		}else{
			$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again!";	
		}
	}

	if(isset($_GET["DisapproveComment"])){
		$IdFromURL=$_GET["DisapproveComment"];
		//$ConnectingDB;
		$Query="UPDATE comments SET status='OFF' WHERE id='$IdFromURL'";
		
		$Execute=mysql_query($Query);
		if($Execute){
			$_SESSION["SuccessMessage"]="Comment Disapproved Successfully";
			//Redirect_to("comments.php");
		}else{
			$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again!";
			//Redirect_to("comments.php");
		}
	}

	if(isset($_GET["DeleteComment"])){
		$IdFromURL=$_GET["DeleteComment"];
		//$ConnectingDB;
		$Query="DELETE FROM comments WHERE id='$IdFromURL'";
		
		$Execute=mysql_query($Query);
		if($Execute){
			$_SESSION["SuccessMessage"]="Comment Deleted Successfully";
			//Redirect_to("comments.php");
		}else{
			$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again!";
			//Redirect_to("comments.php");
		}
	}
?>


<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Jody's Blog</title>
	<link rel="icon" href="images/blog.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mystyles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/myjs.js"></script> <!--needs to be moved to bottom, navs are not highlighting correctly after php? -->
  </head>

  <body>
    <header>
		<div class="card text-white">
		  <img class="card-img" src="images/wave.jpeg" alt="Card image">
		  <div class="card-img-overlay text-center text-white">
			<h1 class="card-title"><a href="index.php?Page=1">Jody's Blog</a></h1>
			<h3 class="card-text">A place to share my experiences, thoughts, and whatever else.</h3>
		  </div>
		</div>
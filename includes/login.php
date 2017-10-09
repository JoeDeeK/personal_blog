
<?php 	

if(isset($_POST["Submit"])){ 
	$Username=mysql_real_escape_string($_POST["username"]);
	$Password=mysql_real_escape_string($_POST["password"]);
	
	if(empty($Username)||empty($Password)){
		$_SESSION["ErrorMessage"]="All Fields must be filled out";
	}else{		
		$Account_Confirmed=Login_Attempt($Username, $Password);
		
		if($Account_Confirmed){
			$_SESSION["User_Id"]=$Account_Confirmed["id"];
			$_SESSION["User_Name"]=$Account_Confirmed["username"];
			
			$_SESSION["SuccessMessage"]="Welcome Back {$_SESSION['User_Name']}!";
			
			Redirect_to("index.php?Dash=true&Login=true&Display=CurrentBlogs"); 
		}else{
			$_SESSION["ErrorMessage"]="Invalid Login";
		}
	}		
}
?>

<div class="container">
	<div class="row justify-content-center">		
		<div class="col-5">
			<?php 
				echo Message();
				echo SuccessMessage();
			?>
			<h2>Login</h2>
			<div>
				<form action="index.php?Dash=true" method="post">
					<fieldset>
						<div class="form-group">
							<label for="username"><span class="FieldInfo">Username:</span></label>
							<div class="input-group input-group-lg">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-user text-success"></span>
								</span>
								<input class="form-control" type="text" name="username" id="username" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<label for="password"><span class="FieldInfo">Password:</span></label>
							<div class="input-group input-group-lg">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-lock text-success"></span>
								</span>
								<input class="form-control" type="Password" name="password" id="password" placeholder="Password">
							</div>
						</div>
						<br>
						<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Login">
					</fieldset>
					<br>
				</form>
			</div>
		</div>
	</div>
</div>
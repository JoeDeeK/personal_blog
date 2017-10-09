<?php 	
	if(isset($_POST["Submit"])){
		$Name=mysql_real_escape_string($_POST["Name"]);
		$Email=mysql_real_escape_string($_POST["Email"]);
		$Comment=mysql_real_escape_string($_POST["Comment"]);
		
		date_default_timezone_set("America/Toronto");
		$CurrentTime=time();
		$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
		$DateTime;
		$PostId=$_GET["Id"];

		if(empty($Name)||empty($Email)||empty($Comment)){
			$_SESSION["ErrorMessage"]="All fields are required";
		}elseif(strlen($Comment)>500){
			$_SESSION["ErrorMessage"]="Only 500 characters allowed for comments";
		}else{
			$PostIdFromUrl=$_GET['Id'];
			$Query="INSERT INTO comments (datetime, name, email, comment, approvedby, status, admin_panel_id)
					VALUES ('$DateTime','$Name','$Email','$Comment', 'Pending', 'OFF','$PostIdFromUrl')"; 
			$Execute=mysql_query($Query);
			
			if($Execute){
				$_SESSION["SuccessMessage"]="Comment Submitted Successfully";
				Redirect_to("index.php?Id={$PostId}");
			}else{
				$_SESSION["ErrorMessage"]="Something went wrong, try again";
				Redirect_to("index.php?Id={$PostId}");
			}
		}			
	}
?>

<?php 
	echo Message();
	echo SuccessMessage();
			
	$PostIDFromUrl=$_GET["Id"];
	$ViewQuery="SELECT * FROM admin_panel WHERE id='$PostIDFromUrl' ORDER BY datetime desc";
					
	$Execute=mysql_query($ViewQuery);
	while($DataRows=mysql_fetch_array($Execute)){
		$PostId=$DataRows["id"];
		$DateTime=$DataRows["datetime"];
		$Title=$DataRows["title"];
		$Category=$DataRows["category"];
		$Admin=$DataRows["author"];
		$Image=$DataRows["image"];
		$Post=$DataRows["post"];
?>

<div class="card mb-3">
	<img class="card-img-top" src="upload/<?php echo $Image; ?>" alt="Card image cap">
	<div class="card-body">
		<h4 class="card-title"><?php echo htmlentities($Title); ?> </h4>
		<p class="card-text text-muted">
			Category: <?php echo htmlentities($Category); ?> <br>
			Published: <?php echo htmlentities($DateTime); ?> <br>
			<?php 
				$QueryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$PostId' AND status='ON'";
				$ExecuteApproved=mysql_query($QueryApproved);
				$RowsApproved=mysql_fetch_array($ExecuteApproved);
				$TotalApproved=array_shift($RowsApproved);
				if($TotalApproved>0){
			?>
					<span class="badge pull-right">
					Comments: 									
					<?php echo $TotalApproved;?>
					</span>
			<?php 
				} 
			?>
		</p>
		<p class="card-text text-muted">
			<?php 
				echo nl2br($Post); 
			?> 
		</p>						
	</div>
</div>
	<?php } ?>

<br><br><br><br>

<span class="FieldInfo">Comments</span>			
<?php
	$PostIdForComments=$_GET["Id"];
	$ExtractingCommentsQuery="SELECT * FROM comments WHERE admin_panel_id='$PostIdForComments' AND status='ON'";
	$Execute=mysql_query($ExtractingCommentsQuery);
	while($DataRows=mysql_fetch_array($Execute)){
		$CommentDate=$DataRows["datetime"];
		$CommentName=$DataRows["name"];
		$CommentByUser=$DataRows["comment"];			
?>
<div class="CommentBlock">
	<img style="margin-top: 10px; margin-left: 10px;" class="pull-left" src="images/comment.png" width="70px"; height="70px";>
	<p style="margin-left: 90px;" class="Comment-info"><?php echo $CommentName; ?></p>
	<p style="margin-left: 90px;" class="description"><?php echo $CommentDate; ?></p>
	<p style="margin-left: 90px;" class="comment"><?php echo nl2br($CommentByUser); ?></p>
</div>
<br>
<hr>
<?php 
	} 
?>
<br>
				
<span class="FieldInfo">Share your thoughts about this post</span>
<div>
	<form action="index.php?Id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="form-group">
				<label for="Name"><span class="FieldInfo">Name:</span></label>
				<input class="form-control" type="text" name="Name" id="Name">
			</div>
			<div class="form-group">
				<label for="Email"><span class="FieldInfo">Email:</span></label>
				<input class="form-control" type="email" name="Email" id="Email">
			</div>
			<div class="form-group">
				<label for="commentarea"><span class="FieldInfo">Comment:</span></label>
				<textarea class="form-control" name="Comment" id="commentarea"></textarea>
			</div>
			<br>
			<input class="btn btn-primary" type="Submit" name="Submit" value="Submit">
		</fieldset>
		<br>
	</form>
</div>			
			
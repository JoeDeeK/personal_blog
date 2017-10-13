
<?php 	
	if(isset($_POST["Submit"])){
		
		$Title=mysql_real_escape_string($_POST["Title"]);
		$Category=mysql_real_escape_string($_POST["Category"]);
		$Post=mysql_real_escape_string($_POST["Post"]);
		
		date_default_timezone_set("America/Toronto");
		$CurrentTime=time();
		$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
		$DateTime;
		
		$Admin=$_SESSION["Username"];

		$DeleteFromURL=$_GET['Delete'];
		$DeleteQuery="DELETE FROM admin_panel WHERE id='$DeleteFromURL'";
		
		$Execute=mysql_query($DeleteQuery);
		if($Execute){
			$_SESSION["SuccessMessage"]="Post Deleted Successfully";
			Redirect_to("index.php?Dash=true&Display=CurrentBlogs");
		}else{
			$_SESSION["ErrorMessage"]="Something went wrong, try again";
		}
	}
?>

<?php 
	echo Message();
	echo SuccessMessage();
?>
<h1>Delete Post</h1>
<div>
	<?php
		$SearchQueryParameter=$_GET['Delete'];
		$Query="SELECT * FROM admin_panel WHERE id='$SearchQueryParameter'";
						
		$ExecuteQuery=mysql_query($Query);
		while($DataRows=mysql_fetch_array($ExecuteQuery)){
			$TitleToBeUpdated=$DataRows['title'];
			$CategoryToBeUpdated=$DataRows['category'];
			$ImageToBeUpdated=$DataRows['image'];
			$PostToBeUpdated=$DataRows['post'];
		}
	?>
	<form action="index.php?Dash=true&Display=DeletePost&Delete=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="form-group">
				<label for="title"><span class="FieldInfo">Title:</span></label>
				<input disabled value="<?php echo $TitleToBeUpdated; ?>" class="form-control" type="text" name="Title" id="title" placeholder="Title">
			</div>
			<div class="form-group">
				<span class="FieldInfo">Category: </span>
				<?php echo $CategoryToBeUpdated;?>
				<br>
			</div>
			<div class="form-group">
				<span class="FieldInfo">Image: </span>
				<img src="upload/<?php echo $ImageToBeUpdated;?>" width="170px"; height="70px";>
				<br>
			</div>
			<div class="form-group">
				<label for="postarea"><span class="FieldInfo">Post:</span></label>
				<textarea disabled class="form-control" name="Post" id="postarea">
					<?php echo $PostToBeUpdated; ?>
				</textarea>
			</div>
			<br>
			<input class="btn btn-danger btn-block" type="Submit" name="Submit" value="Delete Post">
		</fieldset>
		<br>
	</form>
</div>

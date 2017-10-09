
<?php 	
	if(isset($_POST["Submit"])){	
		$Title=mysql_real_escape_string($_POST["Title"]);
		$Category=mysql_real_escape_string($_POST["Category"]);
		$Post=mysql_real_escape_string($_POST["Post"]);
		
		date_default_timezone_set("America/Toronto");
		$CurrentTime=time();
		$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
		$DateTime;
		$Admin=$_SESSION["User_Name"];
		$Image=$_FILES["Image"]["name"];
		$Target="upload/".basename($_FILES["Image"]["name"]);
		
		$SearchQueryParameter=$_GET['Edit'];
		
		if(empty($Title)){
			$_SESSION["ErrorMessage"]="Must enter a title";
		}elseif(strlen($Title)<2 || strlen($Title)>200){
			$_SESSION["ErrorMessage"]="Title must be at least 2 characters long, and no more than 200 characters long";
		}elseif(empty($Category)){
			$_SESSION["ErrorMessage"]="Must select a category";
		}elseif(empty($Image)){
			$_SESSION["ErrorMessage"]="Must upload a image";
		}elseif(empty($Post)){
			$_SESSION["ErrorMessage"]="Post can not be empty";
		}elseif(strlen($Post)>10000){
			$_SESSION["ErrorMessage"]="Post can not me longer than 10000 characters";
		}else{
			$EditFromURL=$_GET['Edit'];
			$Query="UPDATE admin_panel SET datetime='$DateTime', title='$Title',
				category='$Category', author='$Admin', image='$Image', post='$Post'
				WHERE id='$EditFromURL'";
			
			$Execute=mysql_query($Query);
			move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
		
			if($Execute){
				$_SESSION["SuccessMessage"]="Post Updated Successfully";
			}else{
				$_SESSION["ErrorMessage"]="Something went wrong, try again";
			}
		}			
	}
?>

<?php 
	echo Message();
	echo SuccessMessage();
?>
<h1>Edit Post</h1>
<div>
	<?php
		$SearchQueryParameter=$_GET['Edit'];
		$Query="SELECT * FROM admin_panel WHERE id='$SearchQueryParameter'";
			
		$ExecuteQuery=mysql_query($Query);
		while($DataRows=mysql_fetch_array($ExecuteQuery)){
			$TitleToBeUpdated=$DataRows['title'];
			$CategoryToBeUpdated=$DataRows['category'];
			$ImageToBeUpdated=$DataRows['image'];
			$PostToBeUpdated=$DataRows['post'];
		}
	?>
	<form action="index.php?Dash=true&Display=EditPost&Edit=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="form-group">
				<label for="title"><span class="FieldInfo">Title:</span></label>
				<input value="<?php echo $TitleToBeUpdated; ?>" class="form-control" type="text" name="Title" id="title" placeholder="Title">
			</div>
			<div class="form-group">
				<span class="FieldInfo">Existing Category: </span>
				<?php echo $CategoryToBeUpdated;?>
				<br>
				<label for="categoryselect"><span class="FieldInfo">Category:</span></label>
				<select class="form-control" id="categoryselect" name="Category">
					<?php 
						$ViewQuery="SELECT * FROM category ORDER BY datetime desc";
							
						$Execute=mysql_query($ViewQuery);
						while($DataRows=mysql_fetch_array($Execute)){
						  $Id=$DataRows["id"];
						  $CategoryName=$DataRows["name"];
					?>	
					<option><?php echo $CategoryName; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<span class="FieldInfo">Existing Image: </span>
				<img src="upload/<?php echo $ImageToBeUpdated;?>" width="170px"; height="70px";>
				<br>
				<label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
				<input type="File" class="form-control" name="Image" id="imageselect">
			</div>
			<div class="form-group">
				<label for="postarea"><span class="FieldInfo">Post:</span></label>
				<textarea class="form-control" name="Post" id="postarea">
					<?php echo $PostToBeUpdated; ?>
				</textarea>
			</div>
			<br>
			<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Update Post">
		</fieldset>
		<br>
	</form>
</div>
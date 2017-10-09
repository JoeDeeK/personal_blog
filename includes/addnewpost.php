
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
		
		$Image=$_FILES["Image"]["name"];
		$Target="upload/".basename($_FILES["Image"]["name"]);
		
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
			global $ConnectingDB;
			$Query="INSERT INTO admin_panel(datetime,title,category,author,image,post)
			VALUES('$DateTime','$Title','$Category','$Admin','$Image','$Post')";
			$Execute=mysql_query($Query); 
			move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
		
			if($Execute){
				$_SESSION["SuccessMessage"]="Post Added Successfully";
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
				
<h1>Add New Post</h1>
<div>
	<form action="index.php?Dash=true&Display=AddNewPost" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="form-group">
				<label for="title"><span class="FieldInfo">Title:</span></label>
				<input class="form-control" type="text" name="Title" id="title" placeholder="Title">
			</div>
			<div class="form-group">
				<label for="categoryselect"><span class="FieldInfo">Category:</span></label>
				<select class="form-control" id="categoryselect" name="Category">
					<?php 
						global $ConnectingDB;
						$ViewQuery="SELECT * FROM category ORDER BY datetime desc";

						$Execute=mysql_query($ViewQuery);
						while($DataRows=mysql_fetch_array($Execute)){
						  $Id=$DataRows["id"];
						  $CategoryName=$DataRows["name"];
					?>	
					<option><?php echo $CategoryName; ?></option>
					<?php 
						} 
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
				<input type="File" class="form-control" name="Image" id="imageselect">
			</div>
			<div class="form-group">
				<label for="postarea"><span class="FieldInfo">Post:</span></label>
				<textarea class="form-control" name="Post" id="postarea"></textarea>
			</div>
			<br>
			<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Post">
		</fieldset>
		<br>
	</form>
</div>
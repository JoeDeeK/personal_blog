<?php Confirm_Login();?>
<?php 	


if(isset($_POST["Submit"])){
	$Category=mysql_real_escape_string($_POST["Category"]);
	
	date_default_timezone_set("America/Toronto");
	$CurrentTime=time();
	$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
	$DateTime;
	
	$Admin=$_SESSION["Username"];
	if(empty($Category)){
		$_SESSION["ErrorMessage"]="All Fields must be filled out";
	}elseif(strlen($Category)>99){
		$_SESSION["ErrorMessage"]="Too long name for Category";
	}else{
		global $ConnectingDB;
		$Query="INSERT INTO category(datetime,name,creatorname)
		VALUES('$DateTime','$Category','$Admin')";
		
		$Execute=mysql_query($Query);
		if($Execute){
			$_SESSION["SuccessMessage"]="Category Added Successfully";
		}else{
			$_SESSION["ErrorMessage"]="Failed to Add Category";
		}
	}		
}


if(isset($_GET["id"])){
	
	$Id=$_GET["id"];
	
	$ConnectingDB;
	$Query="DELETE FROM category WHERE id='$Id'";
	
	$Execute=mysql_query($Query);
	if($Execute){
		$_SESSION["SuccessMessage"]="Category Deleted Successfully";
	}else{
		$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again!";
	}
}

?>

				<?php 
					echo Message();
					echo SuccessMessage();
				?>
					<h1>Add New Category</h1>
					<div>
						<form action="index.php" method="post">
							<fieldset>
								<div class="form-group">									
									<input class="form-control" type="text" name="Category" id="categoryname" placeholder="Category Name">
								</div>
								<br>
								<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">
							</fieldset>
							<br>
						</form>
					</div>
					
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>Sr No.</th>
								<th>Date & Time</th>
								<th>Category Name</th>
								<th>Creator Name</th>
								<th>Action</th>
							</tr>
								<?php global $ConnectingDB;
									$ViewQuery="SELECT * FROM category ORDER BY id desc";
								
									$Execute=mysql_query($ViewQuery);
									$SrNo=0;
									while($DataRows=mysql_fetch_array($Execute)){
										$Id=$DataRows["id"];
										$DateTime=$DataRows["datetime"];
										$CategoryName=$DataRows["name"];
										$CreatorName=$DataRows["creatorname"];
										$SrNo++;;
								?>
							<tr>
								<td><?php echo $SrNo; ?></td>
								<td><?php echo $DateTime; ?></td>
								<td><?php echo $CategoryName; ?></td>
								<td><?php echo $CreatorName; ?></td>
								<td><a href="index.php?id=<?php echo $Id; ?>"><span class="btn btn-outline-danger">Delete</span></a></td>
							</tr>
								<?php 
									} 
								?>
						</table>
					</div>				
				
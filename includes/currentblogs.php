
<?php 
	echo Message(); 
	echo SuccessMessage() 
?>

					
<h1>Current Blogs</h1>
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<tr>
			<th>No</th>
			<th>Post Title</th>
			<th>Date & Time</th>
			<th>Category</th>
			<th>Banner</th>
			<th>Comments</th>
			<th>Action</th>
			<th>Details</th>				
		</tr>
		<?php 
			$ConnectionDB;
			$ViewQuery="SELECT * FROM admin_panel ORDER BY id desc;";
			$Execute=mysql_query($ViewQuery);
			$SrNo=0;
			while($DataRows=mysql_fetch_array($Execute)){
				$Id=$DataRows["id"];
				$DateTime=$DataRows["datetime"];
				$Title=$DataRows["title"];
				$Category=$DataRows["category"];
				$Image=$DataRows["image"];
				$Post=$DataRows["post"];
				$SrNo++;
		?>
		<tr>
			<td><?php echo $SrNo; ?></td>
			<td style="color: #5e5eff;">
				<?php 
					if(strlen($Title)>16){$Title=substr($Title,0,16).'..';}
					echo $Title; 
				?>
			</td>
			<td>
				<?php
					echo $DateTime; 
				?>
			</td>
			<td>
				<?php 
					if(strlen($Category)>8){$Category=substr($Category,0,8).'..';}
					echo $Category; 
				?>
			</td>
			<td><img src="upload/<?php echo $Image; ?>" width="80"; height="50px";></td>
			<td><?php 
					$ConnectionDB;
					$QueryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='ON'";
					$ExecuteApproved=mysql_query($QueryApproved);
					$RowsApproved=mysql_fetch_array($ExecuteApproved);
					$TotalApproved=array_shift($RowsApproved);
					if($TotalApproved>0){
				?>
				<span class="border border-success rounded">
				<?php echo $TotalApproved;?>
				</span>
		<?php 
			} 
		?>
										
		<?php 
			$ConnectionDB;
			$QueryUnApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='OFF'";
			$ExecuteUnApproved=mysql_query($QueryUnApproved);
			$RowsUnApproved=mysql_fetch_array($ExecuteUnApproved);
			$TotalUnApproved=array_shift($RowsUnApproved);
			if($TotalUnApproved>0){
		?>
		<span class="border border-danger rounded">
		<?php echo $TotalUnApproved;?>
		</span>
		<?php } ?>
		
		</td>
		<td>
			<a href="index.php?Dash=true&Display=EditPost&Edit=<?php echo $Id; ?>">
				<span class="btn btn-outline-warning" style="width: 100%;">Edit</span>
			</a>
			<a href="index.php?Dash=true&Display=DeletePost&Delete=<?php echo $Id; ?>">
				<span class="btn btn-outline-danger">Delete</span>
			</a>
		</td>
		<td>
			<a href="index.php?Id=<?php echo $Id; ?>" target="_blank">
				<span class="btn btn-outline-primary">Live Preview</span>
			</a>
		</td>
		</tr>
		<?php } ?>
	</table>
</div>
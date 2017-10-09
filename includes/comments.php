<?php //Confirm_Login();?>

<div>
	<?php 
		echo Message(); 
		echo SuccessMessage() 
	?>
</div>

<h1>Un-Approved Comments</h1>
<div class="table-responsice">
	<table class="table table-striped table-hover">
		<tr>
			<th>No.</th>
			<th>Name</th>
			<th>Date</th>
			<th>Comment</th>
			<th>Approve</th>
			<th>Delete</th>
			<th>Details</th>
		</tr>
	<?php 
		$Query="SELECT * FROM comments WHERE status='OFF' ORDER BY id DESC";
		$Execute=mysql_query($Query);
		$SrNo=0;
		while($DataRows=mysql_fetch_array($Execute)){
			$CommentId=$DataRows['id'];
			$DateTimeofComment=$DataRows['datetime'];
			$PersonName=$DataRows['name'];
			$PersonComment=$DataRows['comment'];
			$CommentedPostId=$DataRows['admin_panel_id'];
			$SrNo++;
			//if(strlen($PersonComment)>18){$PersonComment = substr($PersonComment,0,18).'...';}
			if(strlen($PersonName)>10){$PersonName = substr($PersonName,0,10).'...';}
	?>
		<tr> 
			<td><?php echo htmlentities($SrNo); ?></td>
			<td style="color: #5e5eff;"><?php echo htmlentities($PersonName); ?></td>
			<td><?php echo htmlentities($DateTimeofComment); ?></td>
			<td><?php echo htmlentities($PersonComment); ?></td>
			<td><a href="index.php?Dash=true&Display=Comments&ApproveComment=<?php echo $CommentId; ?>"><span class="btn btn-success">Approve</span></a></td>
			<td><a href="index.php?Dash=true&Display=Comments&DeleteComment=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span></a></td>
			<td><a href="index.php?Id=<?php echo $CommentedPostId; ?> "target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
		</tr>
	<?php 
		} 
	?>
	</table>
</div>
					
<h1>Approved Comments</h1>
<div class="table-responsice">
	<table class="table table-striped table-hover">
		<tr>
			<th>No.</th>
			<th>Name</th>
			<th>Date</th>
			<th>Comment</th>
			<th>Revert</th>
			<th>Delete</th>
			<th>Details</th>
		</tr>
		<?php 
			$Admin=$_SESSION["Username"];							
			$Query="SELECT * FROM comments WHERE status='ON' ORDER BY id DESC";			
			$Execute=mysql_query($Query);
			$SrNo=0;
			while($DataRows=mysql_fetch_array($Execute)){
				$CommentId=$DataRows['id'];
				$DateTimeofComment=$DataRows['datetime'];
				$PersonName=$DataRows['name'];
				$PersonComment=$DataRows['comment'];
				$CommentedPostId=$DataRows['admin_panel_id'];
				$SrNo++;
				if(strlen($PersonComment)>18){$PersonComment = substr($PersonComment,0,18).'...';}
				if(strlen($PersonName)>10){$PersonName = substr($PersonName,0,10).'...';}
		?>
				<tr>
					<td><?php echo htmlentities($SrNo); ?></td>
					<td style="color: #5e5eff;"><?php echo htmlentities($PersonName); ?></td>
					<td><?php echo htmlentities($DateTimeofComment); ?></td>
					<td><?php echo htmlentities($PersonComment); ?></td>
					<td><a href="index.php?Dash=true&Display=Comments&DisapproveComment=<?php echo $CommentId; ?>"><span class="btn btn-warning">Disapprove</span></a></td>
					<td><a href="index.php?Dash=true&Display=Comments&DeleteComment=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span></a></td>								
					<td><a href="index.php?Id=<?php echo $CommentedPostId; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
				</tr>
		<?php
			} 
		?> 
	</table>
</div> 
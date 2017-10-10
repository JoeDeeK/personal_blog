
</header>

<div class="container">
	<div class="row">
		<div class="col">

<?php
	if(isset($_GET['Id'])){
		include('includes/fullpost.php');
	}else{
		$ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,5";

		if(isset($_GET["SearchButton"])){
			$Search=$_GET["Search"];
			//Query when search button is active
			$ViewQuery="SELECT * FROM admin_panel
						WHERE datetime LIKE '%$Search%'
						OR title LIKE '%$Search%'
						OR category LIKE '%$Search%'
						OR post LIKE '%$Search%'
						ORDER BY id desc";
		}elseif(isset($_GET["Category"])){
			//Query when Category active in URL tab
			$Category=$_GET["Category"];
			$ViewQuery="SELECT * FROM admin_panel WHERE Category='$Category' ORDER BY id desc";
		}elseif(isset($_GET["Page"])){
			//Query when Pagination is active e.g. index.php?Page=1
			$Page=$_GET["Page"];
			if($Page==0||$Page<1){//Stops errors from searching through table for a negative index
				$ShowPostFrom=0;
			}else{
				$ShowPostFrom=($Page*5)-5;
			}
			//Show 5 post at a time, starting with the index controlled by the page # ($ShowPostfrom), to the next '5' post
			$ViewQuery="SELECT * FROM admin_panel ORDER BY id desc LIMIT $ShowPostFrom,5";
		}else{
			//The default query for index.php page
			$ViewQuery="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,5";
		}

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
						<span class="badge badge-secondary">
						Comments:
						<?php echo $TotalApproved;?>
						</span>
				<?php
					}
				?>
				</p>
				<p class="card-text text-muted"><?php
					if(strlen($Post)>300){
						$Post=substr($Post,0,300).'...';
					}
					echo $Post;
				?> </p>

				<a class="ReadMore" href="index.php?Id=<?php echo $PostId; ?>">
					<span class="btn btn-primary">Read More &rsaquo;&rsaquo;</span>
				</a>

			  </div>
			</div>

	<?php
		} //end of while loop
	?>

			<nav>
				<ul class="pagination justify-content-center">
			<?php //Creating backward button
				if(isset($Page)){
					if($Page>1){
			?>
						<li class="page-item"><a class="page-link" href="index.php?Page=<?php echo $Page-1; ?>">&laquo;</a></li>
			<?php
					}
				}
			?>

			<?php
				$QueryPagination="SELECT COUNT(*) FROM admin_panel";

				$ExecutePagination=mysql_query($QueryPagination);
				$RowPagination=mysql_fetch_array($ExecutePagination);
				$TotalPost=array_shift($RowPagination);
				$PostPagination=$TotalPost/5;
				$PostPagination=ceil($PostPagination);

				for($i=1;$i<=$PostPagination;$i++){
					if(isset($Page)){
						if($i==$Page){
			?>
							<li class="page-item active"><a class="page-link" href="index.php?Page=<?php echo $i; ?>"><?php echo $i ?></a></li>
			<?php
						}else{
			?>
							<li class="page-item"><a class="page-link" href="index.php?Page=<?php echo $i; ?>"><?php echo $i ?></a></li>
			<?php
						}
					}
				}
			?>
			<?php //Creating forward button
				if(isset($Page)){
					if($Page+1<=$PostPagination){
			?>
						<li class="page-item"><a class="page-link" href="index.php?Page=<?php echo $Page+1; ?>">&raquo;</a></li>
			<?php
					}
				}
			?>
				</ul>
			</nav>
<?php
	} //End of else statement for no id set
?>
		</div>
		<div class="col-md-3 col-sm-12">
			<?php
				include('includes/sidecolumn.php');
			?>
		</div>
	</div>
</div>

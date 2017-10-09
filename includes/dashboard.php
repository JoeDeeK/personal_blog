
</header>


<div class="container">
	<div class="row">		
		<div class="col-3">
			
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
			  <a class="nav-link <?php if($_GET['Display'] == "CurrentBlogs" || $_GET['Display'] == "EditPost" || $_GET['Display'] == "DeletePost"){echo "active";} ?>" href="?Dash=true&Display=CurrentBlogs"><i class="fa fa-th" aria-hidden="true"></i>  Dashboard</a>
			  <a class="nav-link <?php if($_GET['Display'] == "AddNewPost"){echo "active";} ?>" href="?Dash=true&Display=AddNewPost"><i class="fa fa-list-alt" aria-hidden="true"></i>  Add New Post</a>
			  <a class="nav-link <?php if($_GET['Display'] == "Categories"){echo "active";} ?>" href="?Dash=true&Display=Categories"><i class="fa fa-tags" aria-hidden="true"></i>  Categories</a>
			  <a class="nav-link <?php if($_GET['Display'] == "Comments"){echo "active";} ?>" href="?Dash=true&Display=Comments"><i class="fa fa-comment-o" aria-hidden="true"></i>  Comments
				<?php 
										$ConnectionDB;
										$QueryTotal="SELECT COUNT(*) FROM comments WHERE status='OFF'";
										
										$ExecuteTotal=mysql_query($QueryTotal);
										$RowsTotal=mysql_fetch_array($ExecuteTotal);
										$Total=array_shift($RowsTotal);
										if($Total>0){
										?>
										
										<span class="border border-warning rounded">
										<?php echo $Total;?>
										</span>
										
										<?php } ?>
			  </a>
			  <a class="nav-link" href="?Dash=false"><i class="fa fa-rss" aria-hidden="true"></i>  Live Blog</a>
			  <a class="nav-link" href="?Logout=true"><i class="fa fa-sign-out" aria-hidden="true"></i>  Logout</a>
			</div>
						
		</div>	
		
		<div class="col">
			<?php
				//Case statement for which link clicked, load 2nd column
				if(isset($_GET['Display'])){
					switch ($_GET['Display']) {
						case "CurrentBlogs":
							include('includes/currentblogs.php');
							break;
						case "EditPost":
							include('includes/editpost.php');
							break;
						case "DeletePost":
							include('includes/deletepost.php');
							break;
						case "AddNewPost":
							include('includes/addnewpost.php');
							break;
						case "Categories":
							include('includes/categories.php');
							break;
						case "Comments":
							include('includes/comments.php');
							break;
					}
			  	}else if($_SESSION['User_Name'] && $Dash){
					Redirect_to('index.php?Display=CurrentBlogs'); 
				}
			?>
		</div>
	</div>
</div>

<!-- need to add nav-bar collaspe -->
	<ul class="nav nav-tabs justify-content-center">	
	    <li class="nav-item">
			<a class="nav-link" href="?Page=1">All</a>
		</li>		
		<?php 
		$CategoryQuery="SELECT * FROM category"; //ORDER BY datetime desc
		$Execute=mysql_query($CategoryQuery);
		while($DataRows=mysql_fetch_array($Execute)){
			$Id=$DataRows['id'];
			$Category=$DataRows['name'];
		?>
	    <li class="nav-item">
			<a class="nav-link" href="?Page=1&Category=<?php echo $Category; ?>"><?php echo $Category; ?></a>
		</li>
		<?php 
			} 
		?>		
	</ul>	
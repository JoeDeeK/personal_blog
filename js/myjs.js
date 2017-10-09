$(document).ready(function() {
	
	//Show tabs active or deactive
	$('.nav-link').click(function(){
     $('.nav-link').not(this).each(function(){
         $(this).removeClass('active');
     });
     $(this).addClass('active');
	 
	 if($(this).text() == "All"){
		 //display 5 most recent post (include pagenation on page)
		 //"<?php echo $ViewQuery ?>"="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,5";
		 //alert(<?php $ViewQuery ?>);
	 }else{
		//"<?php echo $ViewQuery ?>"="SELECT * FROM admin_panel WHERE Category='$(this)' ORDER BY id desc";
		
	 }
	 
	})
	
	
	
	
});


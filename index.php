<?php include 'config/header.php'; ?>

<html>
<div id="home_page">
 <body>
     <div>
         <h2>Hello Welcome to the shop have a look around</h2>
		 <br>
		 <br>
		 <h5>Do you like toys or board games well if so this is your one stop shop.<br>
				We try to offer a very whelming experince.<br>
				Sure there are no cool pictures or spinning doo-dads,<br>
				But what we have is more than all of that...<br>
				WE HAVE <form action="#rick_rolled" method="post"> 
		<button class = "btn btn-primary" type="submit" name ="add" value="add"><h1>THIS</h1></button>
		</h5> 
		 <?php
		 if(isset($_POST['add'])){
			echo' <iframe width="840" height="630" src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1" frameborder="0" allowfullscreen></iframe>';
		 }
		 ?>



</body>




</div>
</html>


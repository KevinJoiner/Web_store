
<link rel="stylesheet" type="text/css" href="assets\css\main.css">
<html>
<head>
     <nav class="navbar navbar-default navbar-static-top">


        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class=><a href="index.php">Home</a></li>
                <li><a href="Products.php">Products</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

<?php
session_start();
if(isset($_SESSION['priv'])){
    echo " <li> Hello ". $_SESSION['name']."</li> ";
    if($_SESSION['priv'] == '0'){
        echo '<li> <a href = "cart.php"> View Cart </a></li> ';
    }
	else{
		echo '<li> <a href ="staff.php"> Staff Page </a></li>';
		
	}
}

else{
	echo '<li> <a href = "Sign_in.php"> Sign in </a></li> ';
	
	
}

?>
                
            </ul>
        </div><!--/.nav-collapse -->
    </nav>



</head>



</html>





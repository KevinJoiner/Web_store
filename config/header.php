

<html>
<head>
     <nav class="navbar navbar-default navbar-static-top">


        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="><a href="#">Home</a></li>
                <li><a href="Products.php">Products</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

<?php
session_start();
if(isset($_SESSION['priv'])){
    echo " <li> Hello". $_SESSION['Name']."</li> ";
    if($_SESSION['priv'] == '0'){
        echo '<li> <a href = "cart.php"> View Cart </a></li> ';
    }

}

?>
                <li><a href="../navbar/">Default</a></li>
                <li class="active"><a href="./">Static top <span class="sr-only">(current)</span></a></li>
                <li><a href="../navbar-fixed-top/">Fixed top</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </nav>



</head>



</html>






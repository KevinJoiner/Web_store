<?php include 'config/header.php'; ?>
<?php
if ($_SESSION['priv']!='2' and $_SESSION['priv'] !='1' ){
header('location:index.php');
}
?>

<html>
<body>

<h3> Staff Options</h3>
<ul class="nav">
         <li><a href="#">Create Sales Promotion</a></li>
         <li><a href="./Sign_up_staff.php">Add a new employee</a></li>
         <li><a href="#">Upgrade to manager</a></li>
         <li><a href="inventory.php">View Inventory</a></li>
		 <li><a href="#">Ship pending orders</a></li>
		 <li><a href="#">View Sales stats</a></li>
		 <li><a href="#">View Sales Promotion</a></li>
     </ul>


</body>



</html>
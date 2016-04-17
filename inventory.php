<!DOCTYPE html>
<html>
<head>
<?php include 'config/header.php'; ?>
</head>
<body id = "inventory">
<?php
if ($_SESSION['priv']!='2' and $_SESSION['priv'] !='1' ){
header('location:index.php');
}
?>


<?php
require_once('../sql_connector.php');

$query = "SELECT * FROM product";
$result = $mysqli->query($query);

echo '<table class="table tabel-striped>">
<thead>
    <tr>
 <th><b>Product ID</b></th>
 <th><b>Name</b></th>
 <th><b>Price</b></th>
 <th><b>Quantity</b></th>
 </tr>
 </thead>';
 

 
 while($row = $result->fetch_array(MYSQLI_ASSOC)){
    echo
     '<tr> <td>'. $row['idproduct'].'</td> 
	 <td>'. $row['Name'].'</td>
     <td>$'. $row['Price'].'</td>
	 <td>'. $row['Quantity'].'</td>   </tr>';
	}
	$mysqli->close();
if(isset($_POST['add'])){
	echo '<form action="Processes/add_product.php" method="post">';
	echo'<tr> <td>'."Product ID".'</td> 
	 <td>'. '<input type="text" name="name" size="15" />'.'</td>
     <td>'. '<input type="number" step= "0.01" name="price" min = "0" size="30"/>'.'</td>
	 <td>'. '<input type="text" name="quant" size="15" />'.'</td>   </tr></table>';
	 echo ' <button class = "btn btn-primary" type="submit" name ="submit" value="sent">Submit</button>';
}
else{
	echo'</table>';
	echo ' <a class = "btn btn-primary" href = "update_inv.php"> Update Inventory </a>';
	echo '<form action="#add" method="post"> 
		<button class = "btn btn-primary" type="submit" name ="add" value="add">Add Entry</button>';
	}
	?>



</body>
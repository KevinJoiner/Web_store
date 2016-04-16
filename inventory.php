<?php include 'config/header.php'; ?>
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
	 <td>'. $row['Quantity'].'</td>   </tr>
	 </table>';
 
	$mysqli->close();
	}
	echo ' <a class = "btn btn-primary" href = "update_inv.php"> Update Inventory </a>';
?>
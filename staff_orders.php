
<?php include 'config/header.php'; ?>
<?php
if ($_SESSION['priv']!='2' and $_SESSION['priv'] !='1' ){
header('location:index.php');
}
require_once('../sql_connector.php');
?>

<?php
$query = "SELECT * FROM orders WHERE Status = 'pending';";
$results = $mysqli->query($query);
if ($results!= False){
while($row = $results->fetch_array(MYSQLI_ASSOC)){
	$qry = "SELECT cart.OID, product.promo, product.idproduct, product.Name,product.Price, cart.Quantity 
	FROM cart INNER JOIN product on product.idproduct = cart.ProductID
	WHERE OID = ".$row['OID'].";";
	$order = $mysqli->query($qry);
	echo'<h3> Order '.$row['OID'].' from '.$row['Date'].' is '.$row['Status'].'
			<table class="table tabel-striped>">
			<thead>
				<tr>
			 <th><b>Product ID</b></th>
			 <th><b>Name</b></th>
			 <th><b>Price</b></th>
			 <th><b>Quantity</b></th>
			 </tr>';
			$total = 0;
	While($row2 = $order->fetch_array(MYSQLI_ASSOC)){
	
		 echo '<tr> <td>'. $row2['idproduct'].'</td> 
		 <td>'. $row2['Name'].'</td>';
		 if ($row2['promo'] != 0){
			 $total += (($row2['Price']-$row2['Price']*$row2['promo'])*$row2['Quantity']);
			echo '<td> <div class ="old_price">$'. $row2['Price'].'</div> <div class = "sale">$'.($row2['Price']-($row2['Price']*$row2['promo'])).' </div></td>';
		 }
		 else {
			 $total += ($row2['Price']*$row2['Quantity']);
			 echo '<td>$'. $row2['Price'].'</td>';
		 }
		 echo '<td> '.$row2['Quantity'].'</td>   </tr>';
	}
	echo'<tr> <td>Total</td> 
		 <td></td>
		 <td>$'.$total.'</td><td><form action="Processes/ship.php" method="post"> 
		<button class = "btn btn-primary" type="submit" name ="ship" value="'.$row['OID'].'">Ship Order</button></td> </form>  </tr></table>';

}}

?>
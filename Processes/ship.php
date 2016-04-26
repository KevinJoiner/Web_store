<?php
require_once('../../sql_connector.php');

if(isset($_POST['ship'])){
	$OID = $_POST['ship'];
	$query = "UPDATE orders SET Date = CURDATE() ,Status = 'shipped' WHERE OID =".$OID.";";
	$mysqli->query($query);
	$query = "SELECT * FROM cart Where OID = '".$OID."';";
	$results = $mysqli->query($query);
	while($row = $results->fetch_array(MYSQLI_ASSOC)){
		$qry = "SELECT * FROM product WHERE idproduct =".$row['ProductID'].";";
		$products = $mysqli->query($qry);
		$product = $products->fetch_array(MYSQLI_ASSOC);
		$quant = $product['Quantity'];
		$quant = $quant - $row['quantity'];
		$qry = "UPDATE product SET quantity = ".$quant." WHERE idproduct =".$row['ProductID'].";";
		$mysqli->query($qry);
	}
	if($mysqli->affected_rows == 1){
     $mysqli->close();
      header('location: ../staff_orders.php');
}
}




?>
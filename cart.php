
<?php include 'config/header.php'; ?>

<html>
<div id =cart>
<h2 style ="text-align: center" > What's In Your Cart?</h2>
<table class="table tabel-striped>">
<thead>
    <tr>
 <th><b>Product ID</b></th>
 <th><b>Name</b></th>
 <th><b>Price</b></th>
 <th><b>Quantity</b></th>
 </tr>
 </thead>

<?php
require_once('../sql_connector.php');
if(isset($_POST['PID'])){
	$PID = $_POST['PID'];
	$CID = $_SESSION['user'];
	$quantity = ($_POST['quant']);
	if ($quantity==0)
	{
		$query = "DELETE FROM cart WHERE ProductID = ? and CustomerID =?;";
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param("ii",$PID,$CID);
	}
	else{
		$query = "UPDATE cart SET quantity = ? WHERE ProductID = ? and CustomerID =?;";
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param("iii",$quantity,$PID,$CID);
	}
	$stmt->execute();
	$stmt->close();	
}

	$query = "SELECT cart.OID, product.promo, product.idproduct, product.Name,product.Price, cart.Quantity 
	FROM cart INNER JOIN product on product.idproduct = cart.ProductID
	WHERE cart.CustomerID = ? and cart.OID = (SELECT OID FROM orders WHERE Status = 'in_cart');";
	
	
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("s",$_SESSION['user']);
	$stmt->execute();
	$stmt->bind_result($OID,$promo,$PID,$P_name, $price, $quant);
	

$total =0;
while ($stmt->fetch()) {
	
		echo
		 '<form class ="col-xs-1" action="#" method="post"><tr> <td>'. $PID.'</td> 
		 <td>'. $P_name.'</td>';
		 if ($promo != 0){
			echo '<td> <div class ="old_price">$'. $price.'</div> <div class = "sale">'.($price-($price*$promo)).' </div></td>';
			$total += (($price-$price*$promo)*$quant);
		 }
		 else {
			 echo '<td>$'. $price.'</td>';
			 $total += ($price*$quant);
		 }
		 echo '<td > <input class ="col-xs-1" type="number" value="'.$quant.'"name="quant" min="0" step ="1" />
		<button class = "btn btn-primary " type="submit" name ="PID" value="'.$PID.'">update</button></td></form></tr>';
	}
	$mysqli->close();
	$stmt->close();
	echo'<tr> <td>Total</td> 
		 <td></td>
		 <td>$'.$total.'</td>
		 <td><form action="orders.php" method="post"> 
		<button class = "btn btn-primary" type="submit" name ="OID" value="'.$OID.'">Check Out</button></td> </form>  </tr>';

	
?>



</table>
  












</html

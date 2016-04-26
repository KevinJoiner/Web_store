<?php include 'config/header.php'; ?>
<?php
if ($_SESSION['priv']!='2' ){
header('location:index.php');
}


?>
<div class ="container">
<h2>Search some of our products</h2>
	
	<form class = "panel panel-default" action="#" method="post">
	  <select name="time">
    <option value="week">Week</option>
    <option value="month">Month</option>
    <option value="year">Year</option>
  </select>
   <select name="status">
    <option value="all">All</option>
    <option value="shipped">Shipped</option>
  </select>
  <br><br>
  <input type="submit">
</form>

<?php
require_once('../sql_connector.php');
if(isset($_POST['time'])){
		$week = date('Y-m-d', strtotime("-1 week"));
		$month =date('Y-m-d', strtotime("-1 month"));
		$year = date('Y-m-d', strtotime("-1 year"));
	if($_POST['status'] == 'shipped'){
		if($_POST['time'] == 'week'){
		$query = "SELECT * FROM orders o JOIN cart c on o.OID = c.OID JOIN product p on c.ProductID = p.idproduct
		WHERE o.Status ='shipped' and o.Date >= '" .$week."';";
		}
		elseif($_POST['time'] == 'month'){
		$query = "SELECT * FROM orders o JOIN cart c on o.OID = c.OID JOIN product p on c.ProductID = p.idproduct
		WHERE o.Status ='shipped' and o.Date >= '" .$month."';";
		}
		else{
		$query = "SELECT * FROM orders o JOIN cart c on o.OID = c.OID JOIN product p on c.ProductID = p.idproduct
		WHERE o.Status ='shipped' and o.Date >= '" .$year."';";
		}
	}
	else{
		if($_POST['time'] == 'week'){
		
		$query = "SELECT * FROM orders o JOIN cart c on o.OID = c.OID JOIN product p on c.ProductID = p.idproduct
		WHERE o.Status !='in_cart' and o.Date >= '" .$week."';";
	}
	elseif($_POST['time'] == 'month'){
		$query = "SELECT * FROM orders o JOIN cart c on o.OID = c.OID JOIN product p on c.ProductID = p.idproduct
		WHERE o.Status !='in_cart' and o.Date >= '" .$month."';";
	}
	else{ 
		$query = "SELECT * FROM orders o JOIN cart c on o.OID = c.OID JOIN product p on c.ProductID = p.idproduct
		WHERE o.Status !='in_cart' and o.Date >= '" .$year."';";
	}
	
	
	}
	$result = $mysqli->query($query);
	$total = 0;
	$results = $mysqli->query($query);
	echo'<h3> Orders </h3>
			<table class="table tabel-striped>">
			<thead>
				<tr>
			 <th><b>Product ID</b></th>
			 <th><b>Name</b></th>
			 <th><b>Price</b></th>
			 <th><b>Quantity</b></th>
			  <th><b>Customer ID</b></th>
			 <th><b>Order ID</b></th>
			 </tr>';
	While($row2 = $results->fetch_array(MYSQLI_ASSOC)){
	
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
		 echo '<td> '.$row2['Quantity'].'</td> 
		 <td> '.$row2['CID'].'</td>  
		 <td> '.$row2['OID'].'</td>   </tr>';
	}
	echo'<tr> <td>Total</td> 
		 <td></td>
		 <td>$'.$total.'</td></table>';
}
		
?>
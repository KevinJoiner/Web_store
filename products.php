<!DOCTYPE html>

<html>
<head>
<?php include 'config/header.php'; ?>
</head>
<body id = "product">
<div class ="container">
<h2>Search some of our products</h2>
	
	<form class = "panel panel-default" action="products.php" method="post">
<?php
	if(isset($_POST['submit'])) echo '<h4> Search by name </h4> <input type = "text" name = "name" value ="'.$_POST['name'].'" size = "15"/><br><br>';
	else	echo '<h4> Search by name </h4> <input type = "text" name = "name" size = "15"/><br><br>';
?>		
		<h4> Search by price </h4><br>
<?php
	if(isset($_POST['submit'])) echo '<h4> Min <h4><input type = "number" name="min" size = "2" step ="0.01" min ="0" value="'.$_POST['min'].'"/> <h4> Max <h4><input type = "number" name="max" size = "2" step ="0.01" value="'.$_POST['max'].'"/><br>';
	else	echo '<h4> Min <h4><input type = "number" name="min" size = "2" step ="0.01" min ="0"/> <h4> Max <h4><input type = "number" name="max" size = "2" step ="0.01" /><br>';
?>	
		
		<br><h4>Sort by<h4><br>
		<input type="radio" name="sort" value="price_l">Price $ - $$$ </input>
		<input type="radio" name="sort" value="price_h">Price $$$ - $ </input>
		<input type="radio" name="sort" value="name_A" checked="checked">Name A-Z </input>
		<input type="radio" name="sort" value="name_Z">Name Z-A </input><br>
		<br><input type="submit" name="submit" value="Search"/>
	</form>
</div>	

<table class="table tabel-striped>">
<thead>
    <tr>
 <th><b>Product ID</b></th>
 <th><b>Name</b></th>
 <th><b>Price</b></th>
 </tr>
 </thead>

<?php






require_once('../sql_connector.php');

if (isset($_POST['submit']) ){//and (!empty($_POST['name']) or !empty($_POST['max']) or !empty($_POST['min']))){
    $data_missing = array();
    
	if (empty($_POST['name'])) {
		$data_missing[] = 'name';
	}
	else{
		$f_name = '%'.$mysqli->real_escape_string($_POST['name']).'%';
	}
	if (empty($_POST['min'])) {
		$data_missing[] = 'min';
	}
	else{
		$f_min = $mysqli->real_escape_string($_POST['min']);
	}
	if (empty($_POST['max'])) {
		$data_missing[] = 'max';}
	else{
		$f_max = $mysqli->real_escape_string($_POST['max']);
	}
	if ($_POST['sort']== 'name_A'){
		$f_sort ='Name';
	}
	elseif ($_POST['sort']== 'name_Z'){
		$f_sort ='Name DESC';
	}
	elseif ($_POST['sort']== 'price_l'){
		$f_sort ='Price';
	}
	else {
		$f_sort ='Price DESC';
	}
	
	if(empty($data_missing)){
		$query = "SELECT * FROM product WHERE Name LIKE ? and Price >=? and Price <= ? ORDER BY ". $f_sort;
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param("sdd",$f_name,$f_min,$f_max);
	}
	elseif(count($data_missing) == 3 ){
		$query = "SELECT * FROM product ORDER BY ". $f_sort;
		$stmt = $mysqli->prepare($query);
	}
	elseif($data_missing[0] == 'max'){
		$query = "SELECT * FROM product WHERE Name LIKE ? and Price >=? ORDER BY ". $f_sort;
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param("sd",$f_name,$f_min);
	}
	elseif(count($data_missing)==1 and $data_missing[0] == 'min'){
		$query = "SELECT * FROM product WHERE Name LIKE ? and Price <=? ORDER BY ". $f_sort;
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param("sd",$f_name,$f_max);
	}
	elseif(count($data_missing)==1 and $data_missing[0] == 'Name'){
		$query = "SELECT * FROM product WHERE Price >=? and Price <= ? ORDER BY ". $f_sort;
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param("dd",$f_min,$f_max);
	}
	elseif($data_missing[0] == 'min'){
		$query = "SELECT * FROM product WHERE Name LIKE ? ORDER BY ". $f_sort;
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param("s",$f_name);
	}
	elseif($data_missing[1] == 'min' ){
		$query = "SELECT * FROM product WHERE Price <=? ORDER BY ". $f_sort;
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param("d",$f_max);
	}

	else{
		$query = "SELECT * FROM product WHERE Price >=? ORDER BY ". $f_sort;
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param("d",$f_min);
	}
	$stmt->execute();
	$stmt->bind_result($PID, $Name, $Price, $Quantity);
	
	while ($stmt->fetch()) {
		echo
		 '<tr> <td>'. $PID.'</td> 
		 <td>'. $Name.'</td>
		 <td>$'. $Price.'</td>
		 <td><form action="add_cart.php" method="post"> 
		<button class = "btn btn-primary" type="submit" name ="PID" value="'.$PID.'">Add to cart</button></td>   </tr>';
	}
	$mysqli->close();
	$stmt->close();
}

else{
	$query = "SELECT * FROM product";
	$result = $mysqli->query($query);
	
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		echo
		 '<tr> <td>'. $row['idproduct'].'</td> 
		 <td>'. $row['Name'].'</td>
		 <td>$'. $row['Price'].'</td>
		 <td> <form action="add_cart.php" method="post"> 
		<button class = "btn btn-primary" type="submit" name ="PID" value="'.$row['idproduct'].'">Add to cart</button></td>   </tr>';
	}
	$mysqli->close();
}	
	?>
</table>


</body>
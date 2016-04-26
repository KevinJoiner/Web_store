
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
 <th><b>Promo</b></th>
 <th><b>Quantity</b></th>
 </tr>
 </thead>';
 

 
 while($row = $result->fetch_array(MYSQLI_ASSOC)){
	 
	 if(isset($_POST['PID'])and ($_POST['PID'] ==  $row['idproduct'] )){
	echo '<tr> <form action="Processes/update.php" method="post">';
	echo' <td><input type="hidden" name="PID" value="'.$_POST['PID'].'" />'. $row['idproduct'].'</td>
	 <td>'. '<input type="text" name="name" size="15" value="'.$row['Name'] .'" />'.'</td>
     <td>'. '$<input type="number" step= "0.01" name="price" min = "0" size="30" value="'.$row['Price'] .'" />'.'</td>';
	 if ($_SESSION['priv']=='2'){
	 echo '<td>'. '<input type="number" step= "1" name="promo" min = "0" max = "100" size="30" value="'.$row['promo']*100 .'" />%'.'</td>';}
	 else{
		echo '<td>'. '<input type="hidden" step= "1" name="promo" min = "0" max = "100" size="30" value="'.$row['promo']*100 .'" />'.'</td>';
	 }
	 
	 echo '<td>'. '<input type="text" name="quant" size="15" value="'.$row['Quantity'] .'" />'.'</td>  
	<td> <button class = "btn btn-primary" type="submit" name ="submit" value="submit">Save</button></form>  </tr>';
	 }
	 else{
    echo
     '<tr> <td>'. $row['idproduct'].'</td> 
	 <td>'. $row['Name'].'</td>
     <td>$'. $row['Price'].'</td>
	 <td>'. $row['promo']*100 .'%</td>
	 <td>'. $row['Quantity'].'</td> 
	 <td> <form action="#edit" method="post"> 
		<button class = "btn btn-primary" type="submit" name ="PID" value="'.$row['idproduct'].'">Edit</button></td>  </form> </tr>';
	 }
	 }
	
	$mysqli->close();
if(isset($_POST['add'])){
	echo '<form action="Processes/add_product.php" method="post">';
	echo'<tr> <td>'."Product ID".'</td> 
	 <td>'. '<input type="text" name="name" size="15" />'.'</td>
     <td>'. '$<input type="number" step= "0.01" name="price" min = "0" size="30"/>'.'</td>';
	 if ($_SESSION['priv']=='2'){
	 echo '<td>'. '<input type="number" step= "1" name="promo" min = "0" max = "100" size="30" value="'.$row['promo']*100 .'" />%'.'</td>';}
	 else{
		 echo '<td>'. '<input type="hidden" step= "1" name="promo" min = "0" max = "100" size="30" value="'.$row['promo']*100 .'" />'.'</td>';
	 }
	 echo '<td>'. '<input type="text" name="quant" size="15" />'.'</td>   </tr></table>';
	 echo ' <button class = "btn btn-primary" type="submit" name ="submit" value="sent">Submit</button>';
}
else{
	echo '<tr><form action="#add" method="post"> <td>
		<button class = "btn btn-primary" type="submit" name ="add" value="add">Add Entry</button></td></tr>';
	echo'</table>';
	}
	?>



</body>
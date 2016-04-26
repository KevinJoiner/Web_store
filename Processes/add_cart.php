
<?php
session_start();
if ($_SESSION['priv']!='0'){
header('location:../products.php');
}
?>

<?php
require_once('../../sql_connector.php');
if(isset($_POST['PID'])){
	$f_pid = $mysqli->real_escape_string($_POST['PID']);
	$f_cid = $mysqli->real_escape_string($_SESSION['user']);
}

$query ="SELECT * FROM orders WHERE CID = ".$f_cid." and Status = 'in_cart'";
$results = $mysqli->query($query);
if ($results == False or $results->num_rows ==0){
	echo 'touched';
	$query ="INSERT INTO orders (CID) VALUES (".$f_cid.")";
	$mysqli->query($query);
	$query ="SELECT * FROM orders WHERE CID = ".$f_cid." and Status = 'in_cart'";
	$results = $mysqli->query($query);
}
$row = $results->fetch_array(MYSQLI_ASSOC);
$OID = $row['OID'];
echo $OID;

$query ="INSERT INTO cart (ProductID,CustomerID,OID) VALUES (?,?,?);";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("iii",$f_pid,$f_cid,$OID);
$stmt->execute();
if($mysqli->affected_rows == 1){
	echo 'touched';
	 $stmt->close();
     $mysqli->close();
      header('location: ../cart.php');
}
else{
	echo 'Oops... Something went wrong please try again.';
}
$stmt->close();
$mysqli->close();

?>
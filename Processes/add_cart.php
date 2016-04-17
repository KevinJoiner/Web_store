<?php include 'config/header.php'; ?>
<?php
if ($_SESSION['priv']!='0'{
header('location:../products.php');
}
?>

<?php
require_once('../../sql_connector.php');
if(isset($_POST['PID']){
	$f_pid = $mysqli->real_escape_string($_POST['PID']);
	$f_cid = $mysqli->real_escape_string($_SESSION['user']);
}
$query ="INSERT INTO cart (ProductID,CustomerID) VALUES (?,?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ss",$f_pid,$f_cid);
$stmt->execute();
if($mysqli->affected_rows == 1){
	 $stmt->close();
     $mysqli->close();
      header('location: ../cart.php');
}

	 $stmt->close();
     $mysqli->close();
else{
	echo 'Oops... Something went wrong please try again.'
}


?>
<?php
require_once('../../sql_connector.php');
if(isset($_POST['submit']) and (isset($_POST['PID']))) {
	$f_PID = $mysqli->real_escape_string($_POST['PID']);
    $data_missing = array();
    
	if (empty($_POST['quant'])) {
		$data_missing[] = 'quant';
	}
	else{
		$f_quant = $mysqli->real_escape_string($_POST['quant']);
	}
	if (empty($_POST['price'])) {
		$data_missing[] = 'price';
	}
	else{
		$f_price = $mysqli->real_escape_string($_POST['price']);
	}
	if (empty($_POST['name'])) {
		$data_missing[] = 'name';}
	else{
		$f_name = $mysqli->real_escape_string($_POST['name']);
	}
	
	if (($_POST['promo'] == '' )) {
		$data_missing[] = 'promo';}
	else{
		$f_promo = $mysqli->real_escape_string(($_POST['promo']/100));
	}
	
	if (!empty($_POST['delete'])){
		$query = "DELETE FROM product WHERE idproduct = ?;";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i",$f_PID);
		$stmt->execute();
	}
	elseif(empty($data_missing[0])){
        $query = "UPDATE product SET Name = ?, Price = ?, Quantity = ?, promo = ? WHERE idproduct = ?;";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sdidi",$f_name,$f_price,$f_quant,$f_promo,$f_PID);
		$stmt->execute();
	}
	

        if($mysqli->affected_rows == 1){
			echo 'affected';
			$stmt->close();

            $mysqli->close();
			
            header('location:../inventory.php');
        }
		

	        

    }


?>
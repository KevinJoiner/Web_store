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
	

	if(empty($data_missing[0])){
		echo 'no data missing'.$data_missing;
        $query = "UPDATE product SET Name = ?, Price = ?, Quantity = ? WHERE idproduct = ?;";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sdss",$f_name,$f_price,$f_quant,$f_PID);
		$stmt->execute();
	}
    elseif($data_missing[0] == 'name'){
		$query = "UPDATE product SET Price = ?, Quantity = ? WHERE idproduct = ?;";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("dss",$f_price,$f_quant,$f_PID);
		$stmt->execute();
		
	}
	elseif (count($data_missing) == 1 and $data_missing[0] == 'quant' ){
		$query = "UPDATE product SET Name = ?, Price = ? WHERE idproduct = ?;";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sds",$f_name,$f_price,$f_PID);
		$stmt->execute();
	}
	
	elseif (count($data_missing) == 1 and $data_missing[0] == 'price'){
		$query = "UPDATE product SET Name = ?, Quantity = ? WHERE idproduct = ?;";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sss",$f_name,$f_quant,$f_PID);
		$stmt->execute();	
	}
	
	elseif ($data_missing[1] == 'price'){
		$query = "UPDATE product SET Name = ? WHERE idproduct = ?;";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ss",$f_name,$f_PID);
		$stmt->execute();
	}
	elseif ($data_missing[0] == 'price'){
		$query = "UPDATE product SET Quantity = ? WHERE idproduct = ?;";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ss",$f_quant,$f_PID);
		$stmt->execute();
		
	}
	elseif ($data_missing[0] == 'quant'){
		$query = "UPDATE product SET Price = ? WHERE idproduct = ?;";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ds",$f_price,$f_PID);
		$stmt->execute();
	}
		
	

        if($mysqli->affected_rows == 1){
            header('location:../inventory.php');
        }
		

	         $stmt->close();

            $mysqli->close();

    }


?>
<?php
require_once('../../sql_connector.php');

if(isset($_POST['submit'])) {

    $data_missing = array();

		
		if (empty($_POST['quant'])) {
			$data_missing[] = 'quant';}
		else{
			$f_quant = $mysqli->real_escape_string($_POST['quant']);
		}
		if (empty($_POST['price'])) {
			$data_missing[] = 'price';}
		else{
			$f_price = $mysqli->real_escape_string($_POST['price']);
		}
		if (($_POST['promo']) == '') {
			$data_missing[] = 'promo';}
		else{
			$f_promo = $mysqli->real_escape_string($_POST['promo']/100);
		}
		if (empty($_POST['name'])) {
			$data_missing[] = 'name';}
		else{
			$f_name = $mysqli->real_escape_string($_POST['name']);
		}
	}

	

if(empty($data_missing)){
        $query = "Insert INTO product (Name,Quantity,Price,promo) VALUES (?,?,?,?)";
        $stmt = $mysqli->prepare($query);
		$stmt->bind_param("ssdd",$f_name,$f_quant,$f_price,$f_promo);
		$stmt->execute();
        

        if($mysqli->affected_rows == 1){
            echo 'Product Entered';
			header('location:../inventory.php');
        }
		

	         $stmt->close();

            $mysqli->close();

    }


?>
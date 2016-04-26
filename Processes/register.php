<?php
/**
 * Created by PhpStorm.
 * User: Kevin Joiner
 * Date: 4/3/2016
 * Time: 6:44 PM
 */
require_once('../../sql_connector.php');

if(isset($_POST['submit'])) {

    $data_missing = array();

    if (empty($_POST['name'])) {
        $data_missing[] = 'name';}
    else{
        $f_name = $mysqli->real_escape_string($_POST['name']);

        }


    if (empty($_POST['email'])) {
        $data_missing[] = 'email';}
    else{
        $f_email = $mysqli->real_escape_string($_POST['email']);
    }


    if (empty($_POST['password'])) {
        $data_missing[] = 'password';}
    else{
        $f_password = $mysqli->real_escape_string($_POST['password']);
    }


    if (empty($_POST['streetaddress'])) {
        $data_missing[] = 'streetaddress';}
    else{
        $f_streetaddress = $mysqli->real_escape_string($_POST['streetaddress']);
    }


    if (empty($_POST['cityaddress'])) {
        $data_missing[] = 'cityaddress';}
    else{
        $f_cityaddress = $mysqli->real_escape_string($_POST['cityaddress']);
    }


    if(empty($data_missing)){
        $query = "Insert INTO customer (Name,password,streetaddress,cityaddress,email) VALUES (?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);

        $stmt->bind_param("sssss",$f_name,$f_password,$f_streetaddress,$f_cityaddress,$f_email);
		$stmt->execute();
        

        if($mysqli->affected_rows == 1){
            header('location:../index.php');
        }

	         $stmt->close();

            $mysqli->close();

    }

}

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


    if (empty($_POST['is_manager'])) {
        $f_manager = FALSE;}
    else{
        $f_manager = TRUE;
    }



    if(empty($data_missing)){
        $query = "Insert INTO staff (Name,password,manager,email) VALUES (?,?,?,?)";
        $stmt = $mysqli->prepare($query);

        $stmt->bind_param("ssis",$f_name,$f_password,$f_manager,$f_email);
		$stmt->execute();
        

        if($mysqli->affected_rows == 1){
            echo 'Employee Entered';
        }
		

	         $stmt->close();

            $mysqli->close();

    }

}

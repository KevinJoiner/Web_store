<?php
/**
 * Created by PhpStorm.
 * User: Kevin Joiner
 * Date: 4/3/2016
 * Time: 6:44 PM
 */


if(isset($_POST['submit'])) {

    $data_missing = array();

    if (empty($_POST['name'])) {
        $data_missing[] = 'name';}
    else{
        $f_name = $_POST['name'];

        }


    if (empty($_POST['email'])) {
        $data_missing[] = 'email';}
    else{
        $f_email = $_POST['email'];
    }


    if (empty($_POST['password'])) {
        $data_missing[] = 'password';}
    else{
        $f_password = $_POST['password'];
    }


    if (empty($_POST['streetaddress'])) {
        $data_missing[] = 'streetaddress';}
    else{
        $f_streetaddress = $_POST['streetaddress'];
    }


    if (empty($_POST['cityaddress'])) {
        $data_missing[] = 'cityaddress';}
    else{
        $f_cityaddress = $_POST['cityaddress'];
    }


    if(empty($data_missing)){
        require_once('../../sql_connector.php');
        $query = "Insert INTO customer (Name,password,streetaddress,cityaddress,email) VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($dbc,$query);

        mysqli_stmt_bind_param($stmt,"sssss",$f_name,$f_password,$f_streetaddress,$f_cityaddress,$f_email);
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if($affected_rows == 1){
            echo 'You are all signed up';
        }
        else{
            echo 'You must have entered something wrong go back and try again';
            echo "Don't forget that you can only use and email address once";
        }

	            mysqli_stmt_close($stmt);

            mysqli_close($dbc);

    }

}

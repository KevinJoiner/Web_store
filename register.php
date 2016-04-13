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
    elseif (ctype_alpha(trim($_POST['name']))){
        $f_name = $_POST['name'];

        }
    else{ echo "Invalid Name";}

    if (empty($_POST['email'])) {
        $data_missing[] = 'email';}
    elseif (ctype_alnum($_POST['email'])){
        $f_password = $_POST['email'];
    }
    else{ echo "Invalid password";}

    if (empty($_POST['password'])) {
        $data_missing[] = 'password';}
    elseif (ctype_alnum($_POST['password'])){
        $f_password = $_POST['password'];
    }
    else{ echo "Invalid password";}

    if (empty($_POST['streetaddress'])) {
        $data_missing[] = 'streetaddress';}
    elseif (ctype_alnum(trim($_POST['streetaddress']))){
        $f_streetaddress = $_POST['streetaddress'];
    }
    else{ echo "Invalid Address";}

    if (empty($_POST['cityaddress'])) {
        $data_missing[] = 'cityaddress';}
    elseif (ctype_alpha($_POST['cityaddress'])){
        $f_cityaddress = $_POST['cityaddress'];
    }
    else{ echo "Invalid City";}

    if(empty($data_missing)){
        require_once('../sqlconnector.php');
        $query = "Insert INTO customers (email,Name, password, streetadress, cityaddress) VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($dbc,$query);

        mysqli_stmt_bind_param($stmt,"sissss",$f_name,$f_password,$f_streetaddress,$f_cityaddress);
    }

}

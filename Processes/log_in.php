<?php
require_once('../../sql_connector.php');
if(isset($_POST['submit'])) {
    $f_email = $mysqli->real_escape_string($_POST['email']);
    $f_password = $mysqli->real_escape_string($_POST['password']);
    if(isset($_POST['is_employee'])){
        $f_staff = $_POST['is_employee'];}
    else $f_staff = False ;

    
    if ($f_staff == 'Yes') {
        $stmt = $mysqli->prepare('SELECT Name,idStaff, manager FROM staff WHERE email = ? AND password = ? LIMIT 1');
        $stmt->bind_param("ss",$f_email,$f_password);
		$stmt->bind_result($Name,$CID,$is_manager);
        $stmt->execute();
        $results = $stmt->fetch();
        if ($results ==1){
			session_start();
			$_SESSION['user'] = $CID;
			$_SESSION['name'] = $Name;
			if($is_manager){
				$_SESSION['priv']='2';
			}
			else $_SESSION['priv'] = '1';
			
			header('location:../index.php');
		}
		else{
			echo "Invalid Log in Please go back and try again";
		}


    }

    else  {

        $stmt = $mysqli->prepare('SELECT idCustomer,Name FROM customer WHERE email = ? AND password = ? LIMIT 1');
        $stmt->bind_param("ss",$f_email,$f_password);
		$stmt->bind_result($CID,$name);
        $stmt->execute();
        $results = $stmt->fetch();
        if ($results ==1){
			session_start();
			$_SESSION['priv'] = '0';
			$_SESSION['user'] = $CID;
			$_SESSION['name'] = $name;
			header('location:../index.php');
		}
		else{
			echo "Invalid Log in Please go back and try again";
		}


    }
	$stmt->close();

    $mysqli->close();
}

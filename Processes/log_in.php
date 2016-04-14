<?php
if(isset($_POST['submit'])) {
    $f_email = $_POST['email'];
    $f_password = $_POST['password'];
    if(isset($_POST['is_employee'])){
        $f_staff = $_POST['is_employee'];}
    else $f_staff = 'no' ;

    require_once('../../sql_connector.php');
    if ($f_staff == 'Yes') {
        $qry = "SELECT * FROM staff WHERE email = $f_email  AND password = $f_password LIMIT 1";
        $res=mysqli_query($dbc,$qry);
        if (mysqli_num_rows($res)==1){
            echo 'Logged in';
        }


    }

    else  {

        $stmt = mysqli_prepare($dbc,'SELECT * FROM customer WHERE email = ? AND password = ? LIMIT 1');
        mysqli_stmt_bind_param($stmt,"ss",$f_email,$f_password);
        mysqli_stmt_execute($stmt);
        $results = mysqli_store_result($dbc);
        $info = mysqli_stmt_fetch($stmt);
        if (mysqli_num_rows($results)==1){
            echo 'Logged in as customer';
        }


    }
}

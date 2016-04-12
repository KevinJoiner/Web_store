<?php
require_once('../sqlconnector.php');



$query = "SELECT Name, Price FROM product";

$response = @mysqli_query($dbc, $query);

if($response){
echo '<tabel class="table-striped">
    <tr>
 <td><b>Name</b></td>
 <td><b>Price</b></td>
 </tr>';
}

while($row =mysqli_fetch_array($response)){
    echo'<table class="table-striped active"'.
     '<tr> <td>'. $row['Name'].'</td> 
     <td>'. $row['Price'].'</td>   </tr>';
}





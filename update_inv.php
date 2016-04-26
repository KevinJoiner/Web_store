<?php include 'config/header.php'; ?>
<?php
if ($_SESSION['priv']!='2' and $_SESSION['priv'] !='1' ){
header('location:index.php');
}
?>


<html>
<body>
<div class = "container">
<form action="Processes/update.php" method="post">

<table border="0">

	<tr>
        <td>Product ID</td>
        <td align="center"><input type="text" name="PID" size="30" /></td>
	</tr>

    <tr>
        <td>Name</td>
        <td align="center"><input type="text" name="name" size="30" /></td>
	</tr>
    <tr>
        <td>Price</td>
        <td align = "center">$<input type="number" step = "0.01" name="price" size="30"/> </td>
        
    </tr>
	<tr>
        <td>Quantity</td>
        <td align = "center"><input type="text" name="quant" size="30"/> </td>
        
    </tr>
	<tr>
        <td>Promo</td>
        <td align = "center"><input type="number" step = "1" min ="0" max = "100" name="promo" size="30"/>% </td>
        
    </tr>
	<tr>
		<td>Check for Deletion</td>
        <td align = "center"><input type="checkbox" name="delete" value="Yes"/></td>
	</tr>
	
	 <tr>
        <td colspan="2" align="center"><input type="submit" name="submit" value="Send"/></td>
    </tr>
	

</table>
</form>
</div>
</body>







</html>
<?php include 'config/header.php'; ?>
<?php
if ($_SESSION['priv']!='2' and $_SESSION['priv'] !='1' ){
header('location:index.php');
}
?>


<html>
<body>
<form action="Processes/update.php" method="post">

<table border="0">

	<tr>
        <td>Product ID
        <td align="center"><input type="text" name="PID" size="30" /></td>
	</tr>

    <tr>
        <td>Name
        <td align="center"><input type="text" name="name" size="30" /></td>
	</tr>
    <tr>
        <td>Price
        <td align = "center"><input type="number" step= "0.01" name="price" size="30"/> </td>
        
    </tr>
	<tr>
        <td>Quantity
        <td align = "center"><input type="text" name="quant" size="30" </td>
        
    </tr>
	<tr>
        <td colspan="2" align="center"><input type="submit" name="submit" value="Send"/></td>
    </tr>

</table>
</form>
</body>







</html>
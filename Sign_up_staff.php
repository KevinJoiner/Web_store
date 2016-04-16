<?php include 'config/header.php'; ?>
<html>
<body>
<form action="Processes/register_staff.php" method="post">

<table border="0">

	<tr>
        <td>Name</td>
        <td align="center"><input type="text" name="name" size="30" /></td>
	</tr>

    <tr>
        <td>Password</td>
        <td align="center"><input type="password" name="password" size="30" /></td>
    <tr>
        <td>Email</td>
        <td align = "center"><input type="email" name="email" size="30" </td>
        
    </tr>
    
	    <td>Check for Manager?
    <input type="checkbox" name="is_manager" value="Yes"/></td>
    </tr>

    <tr>
        <td colspan="2" align="center"><input type="submit" name="submit" value="Send"/></td>
    </tr>

</table>
</form>
</body>







</html>
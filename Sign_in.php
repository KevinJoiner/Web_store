<?php
 session_start();
?>

<html>
<body>
<form action="log_in.php" method="post">

<table border="0">

	<tr>
        <td>Name</td>
        <td align="center"><input type="text" name="name" size="30" /></td>
	</tr>

    <tr>
        <td>Password</td>
        <td align="center"><input type="password" name="password" size="30" /></td>
    </tr>
    <tr>
    <td>Are you an employee?</td>
    <input type="checkbox" name="is_employee" value="Yes" />
    </tr>

    <tr>
        <td colspan="2" align="center"><input type="submit" name="submit" value="Send"/></td>
    </tr>
</table>
</form>
</body>



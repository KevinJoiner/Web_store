<?php
 session_start();
?>

<html>
<body>
<form action="Processes/log_in.php" method="post">

<table border="0">

	<tr>
        <td>Email</td>
        <td align="center"><input type="text" name="email" size="30" /></td>
	</tr>

    <tr>
        <td>Password</td>
        <td align="center"><input type="password" name="password" size="30" /></td>
    </tr>
    <tr>
    <td>Are you an employee?
    <input type="checkbox" name="is_employee" value="Yes"/></td>
    </tr>

    <tr>
        <td colspan="2" align="center"><input type="submit" name="submit" value="Send"/></td>
    </tr>
</table>
</form>
</body>



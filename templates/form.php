
<form class="form-basic" method="post" action="<?php __FILE__; ?>" enctype="application/x-www-form-urlencoded">
<h2>Step 1: Database Details: </h2>
<table width="50%" border="0">
<th>Host</th>
<th>Database Name</th>
<th>User</th>
<th>Password</th>
</tr><tr>
<th><input name="host" value="localhost" type="text"></th>
<th><input name="dbname" value="testdb" type="text"></th>
<th><input name="user" value="root" type="text"></th>
<th><input name="password" value="mysql" type="text"></th>
</table>
<br><br>
<h2>Users table</h2>
<table width="50%" border="0">
<th>
  Users table name
</th>
</tr><tr>
<th>
<input name="table" value="table1" type="text">
</th>
</table>
<br>
<h2>Users Fields</h2>
<table width="50%" border="0">
<th>username</th>
<th>password</th>
</tr><tr>
<th><input name="import_user" value="Name" type="text"></th>
<th><input name="import_password" value="id" type="text"></th>
</table>
</table>
<table width="50%" border="0">
<th>
<input type="submit" value="Start">
</th>
<table>
</form>

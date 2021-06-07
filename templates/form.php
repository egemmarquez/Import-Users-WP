
<form class="form-basic" method="post" action="<?php __FILE__; ?>" enctype="application/x-www-form-urlencoded">
<h2>Step 1: Database Details: </h2>
<table width="70%" border="0">
<th>Host</th>
<th>Database Name</th>
</tr><tr>
<th><input name="host" value="localhost" type="text"></th>
<th><input name="dbname" value="testdb" type="text"></th>
</tr><tr>
<th>User</th>
<th>Password</th>
</tr><tr>
<th><input name="user" value="root" type="text"></th>
<th><input name="password" value="mysql" type="text"></th>
</table>
<br><br>
<h2>Users table</h2>
<table width="70%" border="0">
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
<table width="70%" border="0">
<th>username</th>
<th>password</th>
</tr><tr>
<th><input name="import_user" value="email" type="text"></th>
<th><input name="import_password" value="id" type="text"></th>
</tr><tr>
  <th>Name</th>
    <th>Email</th>
</tr><tr>
<th><input name="import_name" value="Name" type="text"></th>
<th><input name="import_email" value="email" type="text"></th>
</tr><tr>
<th colspan="2">Range of users*</th>
</tr><tr>
<td>
<input type="checkbox" name="import_checkrange" value="1"> Set a range of users to import
</td>
</tr><tr>
<th><input name="import_range" value="0" type="text"></th>
<th><input name="import_to" value="100" type="text"></th>
</tr><tr>
<th colspan="2">Import from specific course ID</th>
</tr>
<td colspan="2"><input type="checkbox" name="import_checkcourse" value="1"> Select the course id from inst.org to import the users from that specific course </td>
<tr>
<th><input name="import_coursefield" value="course_id" type="text"></th><th><input name="import_coursevalue" value="30" type="text"></th>
</table>
</table>
<br><br>
*Amount of users imported per iteration. If your database has too many users registered or you just want to import a certain amount of users, set a range.<br>
*Good idea if you are trying to import a table with more of 5000 records.

<table width="70%" border="0">
<th>
<input type="submit" value="Start">
</th>
<table>
</form>

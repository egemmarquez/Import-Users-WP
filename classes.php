<?php
class importdb {
//Connect to the OriginalDB
private function connection($post) {
  //1a- Create connection Array
  $login_credentials = array('host' => $post['host'], 'user' => $post['user'], 'password' => $post['password'], 'dbname' => $post['dbname']);
  //Mysqli connection query
  $mysqli = new mysqli($login_credentials['host'], $login_credentials['user'], $login_credentials['password'], $login_credentials['dbname']);
  if ($mysqli->connect_error) {
  die('Connection Error: <b> (' . $mysqli->connect_errno . ') </b> '. $mysqli->connect_error);
}
else
{
echo "<p></b>Connection Established Successfully</B></p>";
}
return $mysqli;
}

private function duplicates($students, $key)
{
//function to review duplicates. This will review the email field specifically, if its duplicated, it means the same user has purchased
//several courses.
$temp = array_unique(array_column($students, $key));
$unique_arr = array_intersect_key($students, $temp);
print("<br>Removed Duplicated users.<br>");
return $unique_arr;
}

//This function returns an array with all the users we are going to update on the wordpress installation.
public function get_users($post)
{
$mysqli = $this->connection($post);
//if dont die, keep going. Step 3!
//3- We connect to the table to gather the data and create a loop.
$result = $mysqli->query("SELECT $post[import_user], $post[import_password], email from $post[table]");
$users_info = array();
while($assoc = $result->fetch_assoc())
{
array_push($users_info, $assoc);
}
echo "Users gathered from the Database: ";
print $result->num_rows;
$users_info = $this->duplicates($users_info, 'email');
return $users_info;
}

//This function creates a wordpress user using the function wp_create_user https://developer.wordpress.org/reference/functions/wp_create_user/
function create_userswp($arraystudent)
//Now that we have verified the users array it will create the users on the Wordpress database.
{

reset($arraystudent);

foreach($arraystudent as $student)
{
print_r($student);
echo "<br>";
echo $student['Name'];
echo "<br>";
echo $student['id'];
echo "<br>";
echo $student['email'];
echo "<br>";
wp_create_user($student['Name'], $student['id'], $student['email']);
echo "- User ".$student['email']." created.<br>";
}

}

//End of class
}
?>

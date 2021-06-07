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
$limit;
//New options added.
//1st Range: if the checkbox is selected, you can select a range of users

//if import_checkrange is set, it will add to the main query a range of posts to be selected.
if($post['import_checkrange'] == '1')
{
  $limit = "limit $post[import_range], $post[import_to]";
}
//if import_checkcourse is set, it will add to the main query a snippet to import users from a specific course.
if($post['import_checkcourse'] == '1')
{
$where = "where $post[import_coursefield] = $post[import_coursevalue]";
}

$mysqli = $this->connection($post);
//if dont die, keep going. Step 3!
//3- We connect to the table to gather the data and create a loop.
$result = $mysqli->query("SELECT $post[import_user], $post[import_password], $post[import_name], $post[import_email] from $post[table] $where $limit");
//Debug, shows the select query created in the $result variable.
//print "SELECT $post[import_user], $post[import_password], $post[import_name], $post[import_email] from $post[table] $where $limit";
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
//array structure for $arraystudent
//email|id|Name|
//edgar@gmail.com|1|edgar
foreach($arraystudent as $student)
{
//Removed wp_create_user. This function lacks some customization i need for the plugin. I will use wp_insert_user() instead.
//wp_create_user($student['email'], $student['id'], $student['email']);
//wp_insert_user();
//Array must be reformated to work with wp_insert_user
$userdata = array(
'user_login'    =>  $student['email'],
'user_email'    =>  $student['email'],
'user_pass'     =>  $student['id'],
'user_url'      =>  'https://blackfordcentre.com',
'first_name'    =>  $student['Name'],
'last_name'     =>  '',
'nickname'      =>  '',
'description'   =>  '',
'role' => 'Suscriptor'
//For this example, i've added the role Suscriptor, i need to modify the role accordingly.
);

//Verify if the user exists. If it does, it will skip the registration an continue to the next registry.
if(username_exists($student['email']))
{
echo "- User ".$student['email']." already exists. Skipping.<br>";
continue;
}

//if it does not exist, It will register the user accordingly.
if(wp_insert_user($userdata))
{
echo "- User ".$student['email']." created.<br>";
}

}
}

//End of class
}
?>

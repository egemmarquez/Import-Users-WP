<?php
class importdb {
//Connect to the OriginalDB
private function connection($sqlconnection) {
$mysqli = new mysqli($sqlconnection, $sqlconnection, $sqlconnection, $sqlconnection);
echo "Connected to the DB";
print_r($mysqli);
}

public function form_handle()
{
if($_GET['import_users'] == 'start')
{
print_r($_POST);
//We Get query to get the users from the original db
$queryoriginaldb = '';

}

}

}
?>

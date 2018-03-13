<?php
//username comes from last page
$user = $userID;

//log in for server
$server = "192.168.194.154";
$port = "3306";
$username = "user";
$password = "papa-pizza";
$dbname = "pizzaorderapp";

//create connection to DB
$connection = new mysqli($server, $username, $password, $dbname, $port);

//test connection
if($connection->connect_error)
{
    die("Connection failure. Error code: ".$connection->connect_error);
}

//store queries in variable
$deleteAdmin = "DELETE FROM user_accounts WHERE username='$user'";
$deleteTime = "DELETE FROM user_login WHERE username='$user'";

if($connection->query($deleteAdmin) == TRUE && $connection->query($deleteTime) == TRUE){
    echo "Admin successfully deleted";
}
else{
    echo "Unable to delete admin. " . $connection->error;
}

$connection->close();
?>

<?php
//id comes from last page
$idno = $id;

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
$deleteQuery = "DELETE FROM ingredients WHERE ing_id=$idno";

if($connection->query($deleteQuery) == TRUE){
    echo "Ingredient successfully deleted";
}
else{
    echo "Unable to delete ingredient. " . $connection->error;
}

$connection->close();
?>


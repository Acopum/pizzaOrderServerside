<?php
//id comes from last page
//type comes from last page

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
$deleteQuery = "DELETE FROM order_items WHERE item_id=$id AND type='$type'";

if($connection->query($deleteQuery) == TRUE){

    $deleteQuery = "DELETE FROM pizzas WHERE pizza_id=$id";
    $connection->query($deleteQuery);
    echo "Item successfully deleted";
}
else{
    echo "Unable to delete item." . $connection->error;
}

$connection->close();
?>

<br>

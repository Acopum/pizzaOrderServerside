<?php

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

// username to use in query
$userID = "BigB";

// query for notifications
$selectNotification = "SELECT notification_type, messages FROM promotions 
                       INNER JOIN assign_promotion ON promotions.number=assign_promotion.promoID 
                       WHERE TRIM(assign_promotion.username)='$userID';";

$notifQuery = $connection->query($selectNotification);

// if the query was a success and returned results
if ($notifQuery == TRUE && mysqli_num_rows($notifQuery) > 0) {

    // initialize arrays
    $resultArray = array();
    $tempArray = array();

    // store results in an array
    while($row = $notifQuery->fetch_object()) {
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }

    // encode results to JSON string
    echo json_encode($resultArray);
}

// close connection to database
$connection->close();

?>
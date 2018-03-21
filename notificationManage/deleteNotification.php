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
    $deleteNotification = "DELETE FROM promotions WHERE number=$idno";

    if($connection->query($deleteNotification) == TRUE){

        $findNotification = "SELECT username FROM assign_promotion WHERE promoID=$idno";
        $find = $connection->query($findNotification);

        if($find->num_rows > 0){
            while($row=$find->fetch_assoc()){
                $userDelete = $row["username"];
                $updateQuery = "UPDATE user_accounts SET promotions = promotions-1 WHERE username = TRIM('$userDelete')";
                $updateIt = $connection->query($updateQuery);
            }
        }

        $deleteNotification = "DELETE FROM assign_promotion WHERE promoID=$idno";
        $delete = $connection->query($deleteNotification);

        echo "Notification successfully deleted";
    }
    else{
        echo "Unable to delete notification." . $connection->error;
    }

    $connection->close();
?>



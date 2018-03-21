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

    //store queries in variable
    $selectNotification = "SELECT number, notification_type, messages, date FROM promotions INNER JOIN assign_promotion ON promotions.number=assign_promotion.promoID WHERE TRIM(assign_promotion.username)='$userID'";

    //store results
    $notifications = $connection->query($selectNotification);
?>

    <table>
        <tr>
            <td>ID</td>
            <td>Date</td>
            <td>Type</td>
            <td>Content</td>
        </tr>

        <?php
        //run through patient_data table and populate patient info page
        if($notifications->num_rows > 0){
            while($row=$notifications->fetch_assoc()){
                echo "<tr>";

                //rows filled from DB
                echo "<td>".$row["number"]."</td>";
                echo "<td>".$row["date"]."</td>";
                echo "<td>".$row["notification_type"]."</td>";
                echo "<td>".$row["messages"]."</td>";

                echo "<tr>";
            }
        }
        //if patient_data is empty
        else{
            echo " No notifications found.";
        }
        ?>

    </table>
    <br>

<?php
    //close connection
    $connection->close();
?>
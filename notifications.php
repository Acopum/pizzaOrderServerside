<!DOCTYPE HTML>
<html>
<!-- Notifications-->
<head>
    <title>
        PPPP Notifications
    </title>
</head>
<body>
<style>
    th, td {
        border: 1px solid black;
    }
</style>
<h1>
    Notifications Manager
</h1>

<p>
    This menu allows you to manage outbound notifications for mobile users.
</p>

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
    $selectNotifications = "SELECT * FROM promotions ";

    //store results
    $notifications = $connection->query($selectNotifications);
?>

<table>
    <tr>
        <td>ID</td>
        <td>Date</td>
        <td>Type</td>
        <td>Content</td>
        <td>Available Actions</td>
    </tr>

<?php
    //run through patient_data table and populate patient info page
    if($notifications->num_rows > 0){
        while($row=$notifications->fetch_assoc()){
            echo "<tr>";

            $id = $row["number"];

            //rows filled from DB
            echo "<td>".$row["number"]."</td>";
            echo "<td>".$row["date"]."</td>";
            echo "<td>".$row["notification_type"]."</td>";
            echo "<td>".$row["messages"]."</td>";

            //action buttons
            echo "<td><form method=\"post\" action=\"notificationManage\manageNotification.php\">
                           <input type=\"submit\" name=\"action\" value=\"Edit\"/>
                           <input type=\"submit\" name=\"action\" value=\"Delete\"/>
                           <input type=\"hidden\" name=\"id\" value=$id />
                      </form></td>";

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

<form method="post" action="notificationManage\manageNotification.php">
    <input type="submit" name="action" value="Add New Notification"/>
</form>

<form action="ParetoMainMenu.php">
    <input type="submit" name="action" value="Go Back"/>
</form>

<?php
    //close connection
    $connection->close();
?>

</body>
</html>
<!DOCTYPE HTML>
<html>
    <head>
        <title>
            PPPP Notifications
        </title>
        <link rel="stylesheet" type="text/css" href="styleSheets/navigationBars.css">
    </head>
    <div class = "topBanner">
        <h1>
            Papa Pareto's Personal Pizzeria
        </h1>
    </div>
    <div class = "topBar">
        <a href=ParetoMainMenu.php>Home</a>
        <a href=orders.php>Orders</a>
        <a href=ingredients.php>Ingredients</a>
        <a class = "active" href=notifications.php>Notifications</a>
        <a href=admins.php>Admins</a>
        <a href=customers.php>Customers</a>
    </div>
    <body>
        <div class ="mainArea">
            <style>
                th, td {
                    border: 1px solid black;
                }
            </style>
            <h2>
                Notifications Manager
            </h2>
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

                //run through table and populate info page
                if($notifications->num_rows > 0){

                    echo "<table>
                            <tr>
                                <td>ID</td>
                                <td>Date</td>
                                <td>Type</td>
                                <td>Content</td>
                                <td>Available Actions</td>
                            </tr>";

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
                                       <input type=\"submit\" name=\"action\" value=\"Assign\"/>
                                       <input type=\"submit\" name=\"action\" value=\"Edit\"/>
                                       <input type=\"submit\" name=\"action\" value=\"Delete\"/>
                                       <input type=\"hidden\" name=\"id\" value=$id />
                                  </form></td>";

                        echo "<tr>";
                    }
                }
                //if empty
                else{
                    echo " No notifications found.";
                }
                echo "</table>";
            ?>
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
        </div>
    </body>
</html>
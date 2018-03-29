<!DOCTYPE HTML>
<html>
    <head>
        <title>
            PPPP Orders
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
        <a class = "active" href=orders.php>Orders</a>
        <a href=ingredients.php>Ingredients</a>
        <a href=notifications.php>Notifications</a>
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
                Orders Manager
            </h2>
            <p>
                This menu allows you to manage outbound orders.
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
            $selectOrders = "SELECT * FROM orders ";

            //store results
            $orders = $connection->query($selectOrders);
            ?>
            <?php
                //run through table and populate info page
                if($orders->num_rows > 0){
                    echo "<table>
                            <tr>
                                <td>ID</td>
                                <td>Cost</td>
                                <td>Date</td>
                                <td>Customer</td>
                                <td>Address</td>
                                <td>Available Actions</td>
                            </tr>";

                    while($row=$orders->fetch_assoc()){
                        echo "<tr>";

                        $id = $row["order_number"];

                        //rows filled from DB
                        echo "<td>".$id."</td>";
                        echo "<td>$".$row["cost"]."</td>";
                        echo "<td>".$row["time"]."</td>";
                        echo "<td>".$row["customer_name"]."</td>";
                        echo "<td>".$row["address"]."</td>";

                        //action buttons
                        echo "<td><form method=\"post\" action=\"orderManage\manageOrder.php\">
                                       <input type=\"submit\" name=\"action\" value=\"View Contents\"/>
                                       <input type=\"submit\" name=\"action\" value=\"Modify Details\"/>
                                       <input type=\"submit\" name=\"action\" value=\"Cancel Order\"/>
                                       <input type=\"hidden\" name=\"id\" value=$id />
                                  </form></td>";

                        echo "<tr>";
                    }
                }
                //if empty
                else{
                    echo " No orders found.";
                }
                ?>

            </table>
            <br>

            <form method="post" action="orderManage\manageOrder.php">
                <input type="submit" name="action" value="Add Order"/>
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
<!DOCTYPE HTML>
<html>
    <head>
        <title>
            PPPP Customers
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
        <a href=notifications.php>Notifications</a>
        <a href=admins.php>Admins</a>
        <a class = "active" href=customers.php>Customers</a>
    </div>
    <body>
        <div class ="mainArea">
            <style>
                th, td {
                    border: 1px solid black;
                }
            </style>
            <h2>
                Customer Manager
            </h2>

            <p>
                This menu allows you to manage customers.
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
                    $selectCustomer = "SELECT * FROM user_accounts WHERE privledge = 'customer' ";

                    //store results
                    $customers = $connection->query($selectCustomer);

                    //run through table and populate info page
                    if($customers->num_rows > 0){

                        echo "<table>
                                <tr>
                                    <td>Customer Username</td>
                                    <td>Active Notifications</td>
                                    <td>Actions</td>
                                </tr>";

                        while($row=$customers->fetch_assoc()){
                            echo "<tr>";

                            $user = $row["username"];
                            $notno = $row["promotions"];

                            //rows filled from DB
                            echo "<td>".$user."</td>";
                            echo "<td>".$notno."</td>";

                            echo "<td><form method=\"post\" action=\"userManage\manageCustomer.php\">
                                           <input type=\"submit\" name=\"action\" value=\"View Notifications\"/>
                                           <input type=\"hidden\" name=\"username\" value=$user />
                                      </form></td>";

                            echo "<tr>";
                        }
                    }
                    //if is empty
                    else{
                        echo " No customers found.";
                    }
                    echo "</table>";
            ?>
            <br>
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
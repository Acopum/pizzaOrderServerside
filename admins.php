<!DOCTYPE HTML>
<html>
    <head>
        <title>
            PPPP Admins
        </title>
        <link rel="stylesheet" type="text/css" href="styleSheets/navigationBars.css">
    </head>
    <div class = "topBanner">
        <h1>
            Papa Pareto's Personal Pizzeria
        </h1>
    </div>
    <div class = "topBar">
        <a  href=ParetoMainMenu.php>Home</a>
        <a href=orders.php>Orders</a>
        <a href=ingredients.php>Ingredients</a>
        <a href=notifications.php>Notifications</a>
        <a class = "active" href=admins.php>Admins</a>
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
                Admin User Manager
            </h2>

            <p>
                This menu allows you to manage admin logins.
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
                    $selectAdmins = "SELECT * FROM user_accounts WHERE privledge = 'admin' ";

                    //store results
                    $admins = $connection->query($selectAdmins);

                    //run through table and populate info page
                    if($admins->num_rows > 0){

                        echo "<table>
                                <tr>
                                    <td>Username</td>
                                    <td>Actions</td>
                                </tr>";

                        while($row=$admins->fetch_assoc()){
                            echo "<tr>";

                            $user = $row["username"];

                            //rows filled from DB
                            echo "<td>".$user."</td>";

                            //action buttons
                            echo "<td><form method=\"post\" action=\"userManage\manageAdmin.php\">
                                           <input type=\"submit\" name=\"action\" value=\"Remove\"/>
                                           <input type=\"hidden\" name=\"username\" value=$user />
                                      </form></td>";

                            echo "<tr>";
                        }
                    }
                    //if empty
                    else{
                        echo " No admins found.";
                    }
                    echo "</table>";
            ?>
            <br>
            <form method="post" action="userManage\manageAdmin.php">
                <input type="submit" name="action" value="Add Admin"/>
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
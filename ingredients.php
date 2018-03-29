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
        <a href=orders.php>Orders</a>
        <a class = "active" href=ingredients.php>Ingredients</a>
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
                    Ingredients Manager
                </h2>
                <p>
                    This menu allows you to manage ingredients.
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
                    $selectIng = "SELECT * FROM ingredients ";

                    //store results
                    $ingredients = $connection->query($selectIng);

                    //run through table and populate info page
                    if($ingredients->num_rows > 0){

                        echo "<table>
                                <tr>
                                    <td>ID</td>
                                    <td>Name</td>
                                    <td>Cost</td>
                                    <td>Size</td>
                                    <td>Type</td>
                                    <td>Calorie Content</td>
                                    <td>Available Actions</td>
                                </tr>";

                        while($row=$ingredients->fetch_assoc()){
                            echo "<tr>";

                            $id = $row["ing_id"];

                            //rows filled from DB
                            echo "<td>".$id."</td>";
                            echo "<td>".$row["name"]."</td>";
                            echo "<td>$".$row["cost"]."</td>";
                            if(is_null($row["weight"])==FALSE){
                                $row["weight"]=$row["weight"].g;
                            }
                            echo "<td>".$row["weight"]."</td>";
                            echo "<td>".$row["type"]."</td>";
                            echo "<td>".$row["calories"]." Cal</td>";

                            //action buttons
                            echo "<td><form method=\"post\" action=\"ingredientManage\manageIngredient.php\">
                                           <input type=\"submit\" name=\"action\" value=\"Modify\"/>
                                           <input type=\"submit\" name=\"action\" value=\"Remove\"/>
                                           <input type=\"hidden\" name=\"id\" value=$id />
                                      </form></td>";

                            echo "<tr>";
                        }
                    }
                    //if empty
                    else{
                        echo " No ingredients found.";
                    }
                    echo "</table>";
                ?>
            <br>
            <form method="post" action="ingredientManage\manageIngredient.php">
                <input type="submit" name="action" value="Add New Ingredient"/>
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
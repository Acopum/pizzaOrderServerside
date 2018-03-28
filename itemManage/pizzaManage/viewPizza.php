<?php
//function escapes dangerous characters
function cleanup($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

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

?>

    <table>
        <tr>
            <td></td>
            <td>Item Data</td>
        </tr>

        <?php

        $selectQuery = "SELECT * FROM pizzas WHERE pizza_id = $id";
        $pizzaInfo = $connection->query($selectQuery);

        //set variables to blank for update check
        $cost = $crust = $size = $sauce = $cheese = "";
        $topping1 = $topping2 = $topping3 = $topping4 = $topping5 = "";

        if($pizzaInfo->num_rows>0)
        {
            while($row=$pizzaInfo->fetch_assoc()) {
                $cost  = $row["cost"];
                $size = $row["size"];

                $selectQuery = "SELECT name FROM ingredients
                                INNER JOIN pizzas
                                ON pizzas.crust = ingredients.ing_id
                                WHERE pizzas.pizza_id = $id";
                $selectResult = $connection->query($selectQuery);
                $row = $selectResult->fetch_assoc();
                $crust = $row["name"];

                $selectQuery = "SELECT name FROM ingredients
                                INNER JOIN pizzas
                                ON pizzas.sauce = ingredients.ing_id
                                WHERE pizzas.pizza_id = $id";
                $selectResult = $connection->query($selectQuery);
                $row = $selectResult->fetch_assoc();
                $sauce = $row["name"];

                $selectQuery = "SELECT name FROM ingredients
                                INNER JOIN pizzas
                                ON pizzas.cheese = ingredients.ing_id
                                WHERE pizzas.pizza_id = $id";
                $selectResult = $connection->query($selectQuery);
                $row = $selectResult->fetch_assoc();
                $cheese = $row["name"];

                $selectQuery = "SELECT name FROM ingredients
                                INNER JOIN pizzas
                                ON pizzas.topping1 = ingredients.ing_id
                                WHERE pizzas.pizza_id = $id";
                $selectResult = $connection->query($selectQuery);
                $row = $selectResult->fetch_assoc();
                $topping1 = $row["name"];

                $selectQuery = "SELECT name FROM ingredients
                                INNER JOIN pizzas
                                ON pizzas.topping2 = ingredients.ing_id
                                WHERE pizzas.pizza_id = $id";
                $selectResult = $connection->query($selectQuery);
                $row = $selectResult->fetch_assoc();
                $topping2 = $row["name"];

                $selectQuery = "SELECT name FROM ingredients
                                INNER JOIN pizzas
                                ON pizzas.topping3 = ingredients.ing_id
                                WHERE pizzas.pizza_id = $id";
                $selectResult = $connection->query($selectQuery);
                $row = $selectResult->fetch_assoc();
                $topping3 = $row["name"];

                $selectQuery = "SELECT name FROM ingredients
                                INNER JOIN pizzas
                                ON pizzas.topping4 = ingredients.ing_id
                                WHERE pizzas.pizza_id = $id";
                $selectResult = $connection->query($selectQuery);
                $row = $selectResult->fetch_assoc();
                $topping4 = $row["name"];

                $selectQuery = "SELECT name FROM ingredients
                                INNER JOIN pizzas
                                ON pizzas.topping5 = ingredients.ing_id
                                WHERE pizzas.pizza_id = $id";
                $selectResult = $connection->query($selectQuery);
                $row = $selectResult->fetch_assoc();
                $topping5 = $row["name"];

                echo "<tr>";
                echo "<td>Cost</td>";
                echo "<td>$".$cost."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Size</td>";
                echo "<td>$size</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Crust Type</td>";
                echo "<td>$crust</td>";
                echo "</tr>";


                echo "<tr>";
                echo "<td>Sauce</td>";
                echo "<td>$sauce</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Cheese</td>";
                echo "<td>$cheese</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Topping 1</td>";
                echo "<td>$topping1</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Topping 2</td>";
                echo "<td>$topping2</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Topping 3</td>";
                echo "<td>$topping3</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Topping 4</td>";
                echo "<td>$topping4</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Topping 5</td>";
                echo "<td>$topping5</td>";
                echo "</tr>";
            }
        }
        else{
            echo "No item found.";
        }
        ?>

    </table>

<?php
//close connection
$connection->close();
?>

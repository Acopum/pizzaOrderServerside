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

//if submit has been used
if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["subUsed"]==1){

    //clean data
    $cost = cleanup($_POST["costField"]);
    $size = cleanup($_POST["sizeField"]);
    $crust = cleanup($_POST["crustField"]);
    $sauce = cleanup($_POST["sauceField"]);
    $cheese = cleanup($_POST["cheeseField"]);
    $topping1 = cleanup($_POST["top1Field"]);
    $topping2 = cleanup($_POST["top2Field"]);
    $topping3 = cleanup($_POST["top3Field"]);
    $topping4 = cleanup($_POST["top4Field"]);
    $topping5 = cleanup($_POST["top5Field"]);

    if($cost == ""){
        $cost = cleanup($_POST["costOld"]);
    }
    if($size == ""){
        $size = cleanup($_POST["sizeOld"]);
    }
    if($crust == ""){
        $crust = cleanup($_POST["crustOld"]);
    }
    if($sauce == ""){
        $sauce = cleanup($_POST["sauceOld"]);
    }
    if($cheese == ""){
        $cheese = cleanup($_POST["cheeseOld"]);
    }
    if($topping1 == ""){
        $topping1 = cleanup($_POST["top1Old"]);
    }
    if($topping2 == ""){
        $topping2 = cleanup($_POST["top2Old"]);
    }
    if($topping3 == ""){
        $topping3 = cleanup($_POST["top3Old"]);
    }
    if($topping4 == ""){
        $topping4 = cleanup($_POST["top4Old"]);
    }
    if($topping5 == ""){
        $topping5 = cleanup($_POST["top5Old"]);
    }

    //store queries in variable
        $upQuery = "UPDATE pizzas 
                     SET cost=$cost, size='$size', crust=$crust, sauce=$sauce, cheese=$cheese, topping1=$topping1, topping2=$topping2, topping3=$topping3, topping4=$topping4, topping5=$topping5 
                     WHERE pizza_id = $id;";

        //run query and check success
        if ($connection->query($upQuery) == TRUE) {
            echo "Item updated.";
        } else {
            echo "Unable to update item: " . $connection->error;
        }

}
?>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">

        <?php

        $selectQuery = "SELECT * FROM pizzas WHERE pizza_id = $id";
        $pizzaInfo = $connection->query($selectQuery);

        //set variables to blank for update check
        $cost = $crust = $size = $sauce = $cheese = "";
        $topping1 = $topping2 = $topping3 = $topping4 = $topping5 = "";

        if($pizzaInfo->num_rows>0)
        {

            echo "<table>
                    <tr>
                        <td></td>
                        <td>Old Item Data</td>
                        <td>New Item Data</td>
                    </tr>";

            while($row=$pizzaInfo->fetch_assoc())
            {
                $cost = $costOld = $row["cost"];
                $size = $sizeOld = $row["size"];
                $crustOld = $row["crust"];
                $sauceOld = $row["sauce"];
                $cheeseOld = $row["cheese"];
                $topping1Old = $row["topping1"];
                $topping2Old = $row["topping2"];
                $topping3Old = $row["topping3"];
                $topping4Old = $row["topping4"];
                $topping5Old = $row["topping5"];

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
                echo "<td><input type=\"text\" name=\"costField\" maxlength=\"10\"></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Size</td>";
                echo "<td>$size</td>";
                echo "<td><select name=\"sizeField\">
                            <option value=\"\">No Change</option>
                            <option value=\"Small\">Small</option>
                            <option value=\"Medium\">Medium</option>
                            <option value=\"Large\">Large</option>
                            <option value=\"Extra Large\">Extra Large</option>
                          </select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Crust</td>";
                echo "<td>$crust</td>";
                $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Crust'  ORDER BY ing_id ASC";
                $options = $connection->query($selectQuery);

                echo "<td><select name=\"crustField\">";
                echo "<option value=\"\">No Change</option>";
                while($row=$options->fetch_assoc()){
                    $itemName = $row["name"];
                    $itemID = $row["ing_id"];
                    $itemSize = $row["weight"];

                    if(is_null($itemSize)==FALSE){
                        $itemSize = $itemSize."g";
                    }
                    echo "<option value=$itemID>".$itemName." ".$itemSize."</option>";
                }
                echo "</select></td>";
                echo "</tr>";


                echo "<tr>";
                echo "<td>Sauce</td>";
                echo "<td>$sauce</td>";
                $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Sauce'  ORDER BY ing_id ASC";
                $options = $connection->query($selectQuery);
                echo "<td><select name=\"sauceField\">";
                echo "<option value=\"\">No Change</option>";
                while($row=$options->fetch_assoc()){
                    $itemName = $row["name"];
                    $itemID = $row["ing_id"];
                    $itemSize = $row["weight"];

                    if(is_null($itemSize)==FALSE){
                        $itemSize = $itemSize."g";
                    }
                    echo "<option value=$itemID>".$itemName." ".$itemSize."</option>";
                }
                echo "</select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Cheese</td>";
                echo "<td>$cheese</td>";
                $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Cheese'  ORDER BY ing_id ASC";
                $options = $connection->query($selectQuery);
                echo "<td><select name=\"cheeseField\">";
                echo "<option value=\"\">No Change</option>";
                while($row=$options->fetch_assoc()){
                    $itemName = $row["name"];
                    $itemID = $row["ing_id"];
                    $itemSize = $row["weight"];

                    if(is_null($itemSize)==FALSE){
                        $itemSize = $itemSize."g";
                    }
                    echo "<option value=$itemID>".$itemName." ".$itemSize."</option>";
                }
                echo "</select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Topping 1</td>";
                echo "<td>$topping1</td>";
                $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Topping'  ORDER BY ing_id ASC";
                $options = $connection->query($selectQuery);
                echo "<td><select name=\"top1Field\">";
                echo "<option value=\"\">No Change</option>";
                while($row=$options->fetch_assoc()){
                    $itemName = $row["name"];
                    $itemID = $row["ing_id"];
                    $itemSize = $row["weight"];
                    if(is_null($itemSize)==FALSE){
                        $itemSize = $itemSize."g";
                    }
                    echo "<option value=$itemID>".$itemName." ".$itemSize."</option>";
                }
                echo "</select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Topping 2</td>";
                echo "<td>$topping2</td>";
                $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Topping'  ORDER BY ing_id ASC";
                $options = $connection->query($selectQuery);
                echo "<td><select name=\"top2Field\">";
                echo "<option value=\"\">No Change</option>";
                while($row=$options->fetch_assoc()){
                    $itemName = $row["name"];
                    $itemID = $row["ing_id"];
                    $itemSize = $row["weight"];
                    if(is_null($itemSize)==FALSE){
                        $itemSize = $itemSize."g";
                    }
                    echo "<option value=$itemID>".$itemName." ".$itemSize."</option>";
                }
                echo "</select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Topping 3</td>";
                echo "<td>$topping3</td>";
                $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Topping'  ORDER BY ing_id ASC";
                $options = $connection->query($selectQuery);
                echo "<td><select name=\"top3Field\">";
                echo "<option value=\"\">No Change</option>";
                while($row=$options->fetch_assoc()){
                    $itemName = $row["name"];
                    $itemID = $row["ing_id"];
                    $itemSize = $row["weight"];
                    if(is_null($itemSize)==FALSE){
                        $itemSize = $itemSize."g";
                    }
                    echo "<option value=$itemID>".$itemName." ".$itemSize."</option>";
                }
                echo "</select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Topping 4</td>";
                echo "<td>$topping4</td>";
                $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Topping'  ORDER BY ing_id ASC";
                $options = $connection->query($selectQuery);
                echo "<td><select name=\"top4Field\">";
                echo "<option value=\"\">No Change</option>";
                while($row=$options->fetch_assoc()){
                    $itemName = $row["name"];
                    $itemID = $row["ing_id"];
                    $itemSize = $row["weight"];
                    if(is_null($itemSize)==FALSE){
                        $itemSize = $itemSize."g";
                    }
                    echo "<option value=$itemID>".$itemName." ".$itemSize."</option>";
                }
                echo "</select></td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Topping 5</td>";
                echo "<td>$topping5</td>";
                $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Topping'  ORDER BY ing_id ASC";
                $options = $connection->query($selectQuery);
                echo "<td><select name=\"top5Field\">";
                echo "<option value=\"\">No Change</option>";
                while($row=$options->fetch_assoc()){
                    $itemName = $row["name"];
                    $itemID = $row["ing_id"];
                    $itemSize = $row["weight"];
                    if(is_null($itemSize)==FALSE){
                        $itemSize = $itemSize."g";
                    }
                    echo "<option value=$itemID>".$itemName." ".$itemSize."</option>";
                }
                echo "</select></td>";
                echo "</tr>";

                //store action, id, and whether submit is used
                echo "<input type=\"hidden\" name=\"action\" value=\"Edit Item\" />";
                echo "<input type=\"hidden\" name=\"subUsed\" value=1 />";
                echo "<input type=\"hidden\" name=\"type\" value=\"Pizza\" />";
                echo "<input type=\"hidden\" name=\"id\" value=$id />";
				echo "<input type=\"hidden\" name=\"order\" value=$orderID />";

                echo "<input type=\"hidden\" name=\"costOld\" value=$costOld />";
                echo "<input type=\"hidden\" name=\"sizeOld\" value=$sizeOld />";
                echo "<input type=\"hidden\" name=\"sauceOld\" value=$sauceOld />";
                echo "<input type=\"hidden\" name=\"cheeseOld\" value=$cheeseOld />";
                echo "<input type=\"hidden\" name=\"crustOld\" value=$crustOld />";
                echo "<input type=\"hidden\" name=\"top1Old\" value=$topping1Old />";
                echo "<input type=\"hidden\" name=\"top2Old\" value=$topping2Old />";
                echo "<input type=\"hidden\" name=\"top3Old\" value=$topping3Old />";
                echo "<input type=\"hidden\" name=\"top4Old\" value=$topping4Old />";
                echo "<input type=\"hidden\" name=\"top5Old\" value=$topping5Old />";
            }
        }
        else{
            echo "No item found.";
        }
        ?>

    </table>
    <br>
    <input type="submit" value="Submit">
</form>

<?php
//close connection
$connection->close();
?>

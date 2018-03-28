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
    $orderID = cleanup($_POST["orderField"]);

    if($cost == ""){
        echo "<input type=\"hidden\" name=\"subUsed\" value=0 />";
        echo "One of the fields is empty";
    }
    else {
        //store queries in variable
        $addQuery = "INSERT INTO pizzas (cost, size, crust, sauce, cheese, topping1, topping2, topping3, topping4, topping5, order_number) 
                     VALUES ($cost, '$size', $crust, $sauce, $cheese, $topping1, $topping2, $topping3, $topping4, $topping5, $orderID)";
        //run query and check success
        if ($connection->query($addQuery) == TRUE) {
            $addQuery = "INSERT INTO order_items
                     VALUES (LAST_INSERT_ID(), 'Pizza', $orderID)";

            $connection->query($addQuery);
            echo "Item added.";
        } else {
            echo "Unable to add item: " . $connection->error;
        }
    }
}
?>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <table>
        <tr>
            <td></td>
            <td>Item data to be added</td>
        </tr>

        <?php
        //set variables to blank for update check
        $cost = $crust = $size = $sauce = $cheese = "";
        $topping1 = $topping2 = $topping3 = $topping4 = $topping5 = "";

        echo "<tr>";
        echo "<td>Cost</td>";
        echo "<td><input type=\"text\" name=\"costField\" maxlength=\"10\"></td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Size</td>";
        echo "<td><select name=\"sizeField\">
                            <option value=\"Small\">Small</option>
                            <option value=\"Medium\">Medium</option>
                            <option value=\"Large\">Large</option>
                            <option value=\"Extra Large\">Extra Large</option>
                          </select></td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Crust</td>";
        $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Crust'  ORDER BY ing_id ASC";
        $options = $connection->query($selectQuery);
        echo "<td><select name=\"crustField\">";
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
        $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Sauce'  ORDER BY ing_id ASC";
        $options = $connection->query($selectQuery);
        echo "<td><select name=\"sauceField\">";
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
        $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Cheese'  ORDER BY ing_id ASC";
        $options = $connection->query($selectQuery);
        echo "<td><select name=\"cheeseField\">";
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
        $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Topping'  ORDER BY ing_id ASC";
        $options = $connection->query($selectQuery);
        echo "<td><select name=\"top1Field\">";
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
        $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Topping'  ORDER BY ing_id ASC";
        $options = $connection->query($selectQuery);
        echo "<td><select name=\"top2Field\">";
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
        $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Topping'  ORDER BY ing_id ASC";
        $options = $connection->query($selectQuery);
        echo "<td><select name=\"top3Field\">";
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
        $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Topping'  ORDER BY ing_id ASC";
        $options = $connection->query($selectQuery);
        echo "<td><select name=\"top4Field\">";
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
        $selectQuery= "SELECT ing_id, name, weight FROM ingredients WHERE type = 'Topping'  ORDER BY ing_id ASC";
        $options = $connection->query($selectQuery);
        echo "<td><select name=\"top5Field\">";
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
        echo "<input type=\"hidden\" name=\"action\" value=\"Add New Pizza\" />";
        echo "<input type=\"hidden\" name=\"subUsed\" value=1 />";
        echo "<input type=\"hidden\" name=\"type\" value=\"Pizza\" />";
        echo "<input type=\"hidden\" name=\"orderField\" value=$orderID />";
        ?>

    </table>
    <br>
    <input type="submit" value="Submit">
</form>

<?php
//close connection
$connection->close();
?>

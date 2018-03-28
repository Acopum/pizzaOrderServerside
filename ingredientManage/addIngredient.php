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
    $name= cleanup($_POST["nameField"]);
    $size= cleanup($_POST["sizeField"]);
    $type= cleanup($_POST["typeField"]);
    $calories= cleanup($_POST["calField"]);

    if($cost == "" || $type == "" || $name == "" || $size == "" || $calories == ""){
        echo "<input type=\"hidden\" name=\"subUsed\" value=0 />";
        echo "One of the fields is empty";
    }
    else {
        //store queries in variable
        $addQuery = "INSERT INTO ingredients (calories, name, cost, type, weight) VALUES ($calories, '$name', $cost, '$type', $size)";

        //run query and check success
        if ($connection->query($addQuery) == TRUE) {
            echo "Ingredient added.";
        } else {
            echo "Unable to add ingredient: " . $connection->error;
        }
    }
}
?>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <table>
            <tr>
                <td></td>
                <td>New data to be added</td>
            </tr>

            <?php
            //set variables to blank for update check
            $cost = $type = $name = $calories = $size = "";

            echo "<tr>";
            echo "<td>Name</td>";
            echo "<td><input type=\"text\" name=\"nameField\"></td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Cost in CAN</td>";
            echo "<td><input type=\"text\" name=\"costField\"></td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Calories</td>";
            echo "<td><input type=\"text\" name=\"calField\"></td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Size in Grams</td>";
            echo "<td><input type=\"text\" name=\"sizeField\"></td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Ingredient Type</td>";
            echo "<td><select name=\"typeField\">
                            <option value=\"Crust\">Crust</option>
                            <option value=\"Cheese\">Cheese</option>
                            <option value=\"Sauce\">Sauce</option>
                            <option value=\"Topping\">Topping</option>
                          </select></td>";
            echo "</tr>";

            //store action, id, and whether submit is used
            echo "<input type=\"hidden\" name=\"action\" value=\"Add New Ingredient\" />";
            echo "<input type=\"hidden\" name=\"subUsed\" value=1 />";
            ?>

        </table>
        <br>
        <input type="submit" value="Submit">
    </form>

<?php
//close connection
$connection->close();
?>
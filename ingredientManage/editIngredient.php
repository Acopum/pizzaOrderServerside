<?php
//notification ID comes from last page
$idno = $id;

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

    //if any fields unchanged, use old info
    if($cost == ""){
        $cost = $_POST["costOld"];
    }

    if($name == ""){
        $name = $_POST["nameOld"];
    }

    if($size == ""){
        $size = $_POST["sizeOld"];
    }

    if($type == ""){
        $type = $_POST["typeOld"];
    }

    if($calories == ""){
        $calories = $_POST["calOld"];
    }

    //store update query in variable
    $updateQuery = "UPDATE ingredients SET cost=$cost, name='$name', weight=$size, type='$type', calories=$calories WHERE ing_id = $idno";

    //run query and check success
    if ($connection->query($updateQuery) == TRUE) {
        echo "Ingredient updated successfully.";
    }
    else {
        echo "Error: " . $connection->error;
    }
}

//store select queries in variable
$selectQuery = "SELECT * FROM ingredients WHERE ing_id = $idno";

//store results in variables
$Ingredients = $connection->query($selectQuery);

?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">


            <?php
            //initialize variables
            $calories = $cost = $name = $type = $size = "";

            echo "<input type=\"hidden\" name=\"subUsed\" value=0 />";

            if($Ingredients->num_rows > 0){

                echo "<table>
                        <tr>
                            <th></th>
                            <th>Old Ingredient Information</th>
                            <th>New Ingredient Information</th>
                        </tr>";

                while($row=$Ingredients->fetch_assoc()){
                    //store queried row in variables for ease of use
                    $cost =$row["cost"];
                    $name =$row["name"];
                    $calories =$row["calories"];
                    $type =$row["type"];
                    $size =$row["weight"];

                    echo "<tr>";
                    echo "<td>ID</td>";
                    echo "<td>$idno</td>";
                    echo "<td>ID number cannot be edited</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Cost</td>";
                    echo "<td>$$cost</td>";
                    echo "<td><input type=\"text\" name=\"costField\"></td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Name</td>";
                    echo "<td>$name</td>";
                    echo "<td><input type=\"text\" name=\"nameField\"></td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Type</td>";
                    echo "<td>$type</td>";
                    echo "<td><select name=\"typeField\">
                            <option value=\"Crust\">Crust</option>
                            <option value=\"Cheese\">Cheese</option>
                            <option value=\"Sauce\">Sauce</option>
                            <option value=\"Topping\">Topping</option>
                          </select></td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Calorie Content</td>";
                    echo "<td>$calories</td>";
                    echo "<td><input type=\"text\" name=\"calField\"></td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Size</td>";
                    echo "<td>$size</td>";
                    echo "<td><input type=\"text\" name=\"sizeField\"></td>";
                    echo "</tr>";


                    //store action, id, and whether submit is used
                    echo "<input type=\"hidden\" name=\"action\" value=\"Modify\" />";
                    echo "<input type=\"hidden\" name=\"id\" value=$idno />";
                    echo "<input type=\"hidden\" name=\"subUsed\" value=1 />";

                    //store old data for POST
                    echo "<input type=\"hidden\" name=\"costOld\" value= \"$cost\" />";
                    echo "<input type=\"hidden\" name=\"nameOld\" value= \"$name\" />";
                    echo "<input type=\"hidden\" name=\"typeOld\" value= \"$type\" />";
                    echo "<input type=\"hidden\" name=\"sizeOld\" value= \"$size\" />";
                    echo "<input type=\"hidden\" name=\"calOld\" value= \"$calories\" />";
                }
            }
            else{
                echo "No ingredient found!";
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
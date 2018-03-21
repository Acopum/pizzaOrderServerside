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
    $cust = cleanup($_POST["custField"]);
    $address= cleanup($_POST["addressField"]);


    if($cost == "" || $cust == "" || $address == ""){
        echo "<input type=\"hidden\" name=\"subUsed\" value=0 />";
        echo "One of the fields is empty";
    }
    else {
        //store queries in variable
        $addQuery = "INSERT INTO pizza_orders (cost, customer_name, address) VALUES ($cost, '$cust', '$address')";

        //run query and check success
        if ($connection->query($addQuery) == TRUE) {
            echo "Order added.";
        } else {
            echo "Unable to add order: " . $connection->error;
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
        $cost = $cust = $address = "";

        echo "<tr>";
        echo "<td>Cost</td>";
        echo "<td><input type=\"text\" name=\"costField\" maxlength=\"10\"></td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Customer Name</td>";
        echo "<td><input type=\"text\" name=\"custField\"></td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Address</td>";
        echo "<td><input type=\"text\" name=\"addressField\"></td>";
        echo "</tr>";

        //store action, id, and whether submit is used
        echo "<input type=\"hidden\" name=\"action\" value=\"Add Order\" />";
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

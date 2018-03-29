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
    $date= cleanup($_POST["dateField"]);
    $customer= cleanup($_POST["customerField"]);
    $address= cleanup($_POST["addressField"]);

    //if any fields unchanged, use old info
    if($cost == ""){
        $cost = $_POST["costOld"];
    }

    if($date == ""){
        $date = $_POST["dateOld"];
    }

    if($customer == ""){
        $customer = $_POST["customerOld"];
    }

    if($address == ""){
        $address = $_POST["addressOld"];
    }

    //store update query in variable
    $updateQuery = "UPDATE orders SET cost=$cost, time='$date', customer_name='$customer', address='$address' WHERE order_number = $idno";

    //run query and check success
    if ($connection->query($updateQuery) == TRUE) {
        echo "Order updated successfully.";
    }
    else {
        echo "Error: " . $connection->error;
    }
}

//store select queries in variable
$selectQuery = "SELECT * FROM orders WHERE order_number = $idno";

//store results in variables
$selectOrder = $connection->query($selectQuery);

?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">

            <?php
            //initialize variables
            $cost = $date = $customer = $address = "";

            echo "<input type=\"hidden\" name=\"subUsed\" value=0 />";

            if($selectOrder->num_rows > 0){

                echo "<table>
                        <tr>
                            <th></th>
                            <th>Old Order Details</th>
                            <th>New Order Details</th>
                        </tr> ";

                while($row=$selectOrder->fetch_assoc()){
                    //store queried row in variables for ease of use
                    $cost =$row["cost"];
                    $date =$row["time"];
                    $customer =$row["customer_name"];
                    $address =$row["address"];

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
                    echo "<td>Date</td>";
                    echo "<td>$date</td>";
                    echo "<td><input type=\"text\" name=\"dateField\"></td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Customer</td>";
                    echo "<td>$customer</td>";
                    echo "<td><input type=\"text\" name=\"customerField\"></td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Address</td>";
                    echo "<td>$address</td>";
                    echo "<td><input type=\"text\" name=\"addressField\"></td>";
                    echo "</tr>";

                    //store action, id, and whether submit is used
                    echo "<input type=\"hidden\" name=\"action\" value=\"Edit\" />";
                    echo "<input type=\"hidden\" name=\"id\" value=$idno />";
                    echo "<input type=\"hidden\" name=\"subUsed\" value=1 />";

                    //store old data for POST
                    echo "<input type=\"hidden\" name=\"costOld\" value= \"$cost\" />";
                    echo "<input type=\"hidden\" name=\"dateOld\" value= \"$date\" />";
                    echo "<input type=\"hidden\" name=\"customerOld\" value= \"$customer\" />";
                    echo "<input type=\"hidden\" name=\"addressOld\" value= \"$address\" />";
                }
            }
            else{
                echo "No order found!";
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
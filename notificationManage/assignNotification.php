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
    $type = cleanup($_POST["typeField"]);
    $date= cleanup($_POST["dateField"]);
    $content= cleanup($_POST["contentField"]);

    //if any fields unchanged, use old info
    if($type == ""){
        $type = $_POST["typeOld"];
    }

    if($date == ""){
        $date = $_POST["dateOld"];
    }

    if($content == ""){
        $content = $_POST["contentOld"];
    }

    //store update query in variable
    $updateQuery = "UPDATE promotions SET date='$date',notification_type='$type',messages='$content' WHERE number = $idno";

    //run query and check success
    if ($connection->query($updateQuery) == TRUE) {
        echo "Notification updated successfully.";
    }
    else {
        echo "Error: " . $connection->error;
    }
}

//store select queries in variable
$selectQuery = "SELECT date, notification_type, messages FROM promotions WHERE number = $idno";

//store results in variables
$selectNotification = $connection->query($selectQuery);

?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <table>
            <tr>
                <th></th>
                <th>Old Notification Data</th>
                <th>New Notification Data</th>
            </tr>

            <?php
            //initialize variables
            $type = $date = $content = "";

            echo "<input type=\"hidden\" name=\"subUsed\" value=0 />";

            if($selectNotification->num_rows > 0){
                while($row=$selectNotification->fetch_assoc()){
                    //store queried row in variables for ease of use
                    $type =$row["notification_type"];
                    $date =$row["date"];
                    $content =$row["messages"];

                    echo "<tr>";
                    echo "<td>ID</td>";
                    echo "<td>$idno</td>";
                    echo "<td>ID number cannot be edited</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Date</td>";
                    echo "<td>$date</td>";
                    echo "<td><input type=\"text\" name=\"dateField\"></td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Type</td>";
                    echo "<td>$type</td>";
                    echo "<td><input type=\"text\" name=\"typeField\"></td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Content</td>";
                    echo "<td>$content</td>";
                    echo "<td><input type=\"text\" name=\"contentField\"></td>";
                    echo "</tr>";

                    //store action, id, and whether submit is used
                    echo "<input type=\"hidden\" name=\"action\" value=\"Edit\" />";
                    echo "<input type=\"hidden\" name=\"id\" value=$idno />";
                    echo "<input type=\"hidden\" name=\"subUsed\" value=1 />";

                    //store old data for POST
                    echo "<input type=\"hidden\" name=\"dateOld\" value= \"$date\" />";
                    echo "<input type=\"hidden\" name=\"typeOld\" value= \"$type\" />";
                    echo "<input type=\"hidden\" name=\"contentOld\" value= \"$content\" />";

                }
            }
            else{
                echo "No notification found!";
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
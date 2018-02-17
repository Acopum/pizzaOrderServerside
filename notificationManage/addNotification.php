<?php
    //function escapes dangerous characters
    function cleanup($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //log in for actual server
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
        $idno = cleanup($_POST["idField"]);
        $type = cleanup($_POST["typeField"]);
        $date= cleanup($_POST["dateField"]);
        $content= cleanup($_POST["contentField"]);

        //if any fields unchanged, use old info
        if($idno == "" || $type == "" || $content == "" || $date == ""){
            echo "<input type=\"hidden\" name=\"subUsed\" value=0 />";
            echo "One of the fields is empty";
        }
        else if(strlen((string) $idno) < 10 ){
            echo "ID must be at least 10 digits";
        }
        else {
            //store queries in variable
            $addQuery = "INSERT INTO promotions VALUES ($idno, '$type', '$content', '$date')";

            //run query and check success
            if ($connection->query($addQuery) == TRUE) {
                echo "Notification added.";
            } else {
                echo "Unable to add notification: " . $connection->error;
            }
        }
    }
?>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <table>
        <tr>
            <td></td>
            <td>New Data</td>
        </tr>

<?php
    //set variables to blank for update check
    $idno = $type = $date = $content = "";

    echo "<tr>";
    echo "<td>ID</td>";
    echo "<td><input type=\"text\" name=\"idField\" maxlength=\"10\"></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>Type</td>";
    echo "<td><input type=\"text\" name=\"typeField\"></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>Content</td>";
    echo "<td><input type=\"text\" name=\"contentField\"></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>Date</td>";
    echo "<td><input type=\"text\" name=\"dateField\"></td>";
    echo "</tr>";

    //store action, id, and whether submit is used
    echo "<input type=\"hidden\" name=\"action\" value=\"Add New Notification\" />";
    echo "<input type=\"hidden\" name=\"subUsed\" value=1 />";
?>

    </table>
    <br>
    <input type="submit" value="Submit">
</form>

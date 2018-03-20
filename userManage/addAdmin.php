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
    $user = cleanup($_POST["userField"]);
    $pass = cleanup($_POST["passField"]);
    $salt = cleanup($_POST["salt"]);

    if($user == "" || $pass == "" || $salt == ""){
        echo "<input type=\"hidden\" name=\"subUsed\" value=0 />";
        echo "One of the fields is empty";
    }
    else {
        //store queries in variable
        $hash = md5($pass.$salt);
        $addQuery = "INSERT INTO user_accounts VALUES ('$user', '$hash', 'admin', '$salt', 0)";
        $addTime = "INSERT INTO user_login VALUES ('$user', 0, 0)";

        //run query and check success
        if ($connection->query($addQuery) == TRUE && $connection->query($addTime) == TRUE) {
            echo "Admin added.";
        } else {
            echo "Unable to add admin: " . $connection->error;
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
        $user = $pass = $salt = "";
        $salt = rand (10000, 99999);

        echo "<tr>";
        echo "<td>Username</td>";
        echo "<td><input type=\"text\" name=\"userField\"></td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Password</td>";
        echo "<td><input type=\"text\" name=\"passField\"></td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Salt</td>";
        echo "<td>$salt</td>";
        echo "</tr>";

        //store action, id, and whether submit is used
        echo "<input type=\"hidden\" name=\"action\" value=\"Add Admin\" />";
        echo "<input type=\"hidden\" name=\"subUsed\" value=1 />";
        echo "<input type=\"hidden\" name=\"salt\" value=$salt />";
        ?>

    </table>
    <br>
    <input type="submit" value="Submit">
</form>

<!DOCTYPE HTML>
<html>
<head>
    <title>
        PPPP Admins
    </title>
</head>
<body>
<style>
    th, td {
        border: 1px solid black;
    }
</style>
<h1>
    Admin User Manager
</h1>

<p>
    This menu allows you to manage admin logins.
</p>

<?php
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

//store queries in variable
$selectAdmins = "SELECT * FROM user_accounts WHERE privledge = 'admin' ";

//store results
$admins = $connection->query($selectAdmins);
?>

<table>
    <tr>
        <td>Username</td>
        <td>Actions</td>
    </tr>

    <?php
    //run through table and populate info page
    if($admins->num_rows > 0){
        while($row=$admins->fetch_assoc()){
            echo "<tr>";

            $user = $row["username"];

            //rows filled from DB
            echo "<td>".$user."</td>";

            //action buttons
            echo "<td><form method=\"post\" action=\"userManage\manageAdmin.php\">
                           <input type=\"submit\" name=\"action\" value=\"Remove\"/>
                           <input type=\"hidden\" name=\"username\" value=$user />
                      </form></td>";

            echo "<tr>";
        }
    }
    //if empty
    else{
        echo " No admins found.";
    }
    ?>

</table>
<br>

<form method="post" action="userManage\manageAdmin.php">
    <input type="submit" name="action" value="Add Admin"/>
</form>

<form action="ParetoMainMenu.php">
    <input type="submit" name="action" value="Go Back"/>
</form>

<?php
//close connection
$connection->close();
?>

</body>
</html>
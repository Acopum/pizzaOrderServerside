<!DOCTYPE HTML>
<html>
<!-- Notifications-->
<head>
    <title>
        PPPP
    </title>
</head>
<body>
<style>
    th, td {
        border: 1px solid black;
    }
</style>
<h1>
    Customer Manager
</h1>

<p>
    This menu allows you to manage customers.
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
$selectCustomer = "SELECT * FROM user_accounts WHERE privledge = 'customer' ";

//store results
$customers = $connection->query($selectCustomer);
?>

<table>
    <tr>
        <td>Customer Username</td>
        <td>Active Notifications</td>
        <td>Actions</td>
    </tr>

    <?php
    //run through patient_data table and populate patient info page
    if($customers->num_rows > 0){
        while($row=$customers->fetch_assoc()){
            echo "<tr>";

            $user = $row["username"];
            $notno = $row["promotions"];

            //rows filled from DB
            echo "<td>".$user."</td>";
            echo "<td>".$notno."</td>";

            echo "<td><form method=\"post\" action=\"userManage\manageCustomer.php\">
                           <input type=\"submit\" name=\"action\" value=\"View Notifications\"/>
                           <input type=\"hidden\" name=\"username\" value=$user />
                      </form></td>";

            echo "<tr>";
        }
    }
    //if patient_data is empty
    else{
        echo " No notifications found.";
    }
    ?>

</table>
<br>

<form action="ParetoMainMenu.php">
    <input type="submit" name="action" value="Go Back"/>
</form>

<?php
//close connection
$connection->close();
?>

</body>
</html>
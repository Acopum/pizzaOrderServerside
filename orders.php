<!DOCTYPE HTML>
<html>
<head>
    <title>
        PPPP Orders
    </title>
</head>
<body>
<style>
    th, td {
        border: 1px solid black;
    }
</style>
<h1>
    Orders Manager
</h1>

<p>
    This menu allows you to manage outbound orders.
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
$selectOrders = "SELECT * FROM pizza_orders ";

//store results
$orders = $connection->query($selectOrders);
?>

<table>
    <tr>
        <td>ID</td>
        <td>Cost</td>
        <td>Date</td>
        <td>Customer</td>
        <td>Address</td>
        <td>Available Actions</td>
    </tr>

    <?php
    //run through table and populate info page
    if($orders->num_rows > 0){
        while($row=$orders->fetch_assoc()){
            echo "<tr>";

            $id = $row["order_number"];

            //rows filled from DB
            echo "<td>".$id."</td>";
            echo "<td>$".$row["cost"]."</td>";
            echo "<td>".$row["time"]."</td>";
            echo "<td>".$row["customer_name"]."</td>";
            echo "<td>".$row["address"]."</td>";

            //action buttons
            echo "<td><form method=\"post\" action=\"orderManage\manageOrder.php\">
                           <input type=\"submit\" name=\"action\" value=\"Edit\"/>
                           <input type=\"submit\" name=\"action\" value=\"Remove\"/>
                           <input type=\"hidden\" name=\"id\" value=$id />
                      </form></td>";

            echo "<tr>";
        }
    }
    //if empty
    else{
        echo " No orders found.";
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
<!DOCTYPE HTML>
<html>
<!-- Admins -->
<head>
    <title>
        PPPP Customers
    </title>
</head>
<style>
    th, td {
        border: 1px solid black;
    }
</style>
<body>
<h1>
    Customer Manager
</h1>

<?php
$userID = $_POST["username"];

if($_POST["action"]=="View Notifications")
{
    include('viewPromos.php');
}
else
{
    echo "ERROR";
}
?>

<br>

<form action="/TestFiles/pizzaOrderServerside/customers.php">
    <input type="submit" name="action" value="Go Back"/>
</form>

</body>
</html>

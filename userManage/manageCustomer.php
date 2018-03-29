<!DOCTYPE HTML>
<html>
<!-- Customers -->
<head>
    <title>
        PPPP Customers
    </title>
    <link rel="stylesheet" type="text/css" href="../styleSheets/navigationBars.css">
</head>
<div class = "topBanner">
    <h1>
        Papa Pareto's Personal Pizzeria
    </h1>
</div>

<div class = "topBar">
    <a  href=../ParetoMainMenu.php>Home</a>
    <a href=../orders.php>Orders</a>
    <a href=../ingredients.php>Ingredients</a>
    <a href=../notifications.php>Notifications</a>
    <a href=../admins.php>Admins</a>
    <a class = "active" href=../customers.php>Customers</a>
</div>
<body>
<div class ="mainArea">
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
</div>
</body>
</html>

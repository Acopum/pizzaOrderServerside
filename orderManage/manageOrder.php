<!DOCTYPE HTML>
<html>
<!-- Orders -->
<head>
    <title>
        PPPP Orders
    </title>
    <link rel="stylesheet" type="text/css" href="../styleSheets/navigationBars.css">
</head>
<div class = "topBanner">
    <h1>
        Papa Pareto's Personal Pizzeria
    </h1>
</div>

<div class = "topBar">
    <a href=../ParetoMainMenu.php>Home</a>
    <a class = "active" href=../orders.php>Orders</a>
    <a href=../ingredients.php>Ingredients</a>
    <a href=../notifications.php>Notifications</a>
    <a href=../admins.php>Admins</a>
    <a href=../customers.php>Customers</a>
</div>
<body>
<div class ="mainArea">
<h2>
    Order Manager
</h2>

<?php
$id = $_POST["id"];

if($_POST["action"]=="Cancel Order")
{
    include('deleteOrder.php');
}
else if($_POST["action"]=="Modify Details")
{
    include('editOrder.php');
}
else if($_POST["action"]=="View Contents")
{
    include('contentOrder.php');
}
else if($_POST["action"]=="Add Order")
{
    include('addOrder.php');
}
else
{
    echo "ERROR";
}
?>

<br>

<form action="/TestFiles/pizzaOrderServerside/orders.php">
    <input type="submit" name="action" value="Go Back"/>
</form>
</div>
</body>
</html>

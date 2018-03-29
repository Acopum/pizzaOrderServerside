<!DOCTYPE HTML>
<html>
<!-- Admins -->
<head>
    <title>
        PPPP Admins
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
    <a href=../orders.php>Orders</a>
    <a href=../ingredients.php>Ingredients</a>
    <a href=../notifications.php>Notifications</a>
    <a class = "active" href=../admins.php>Admins</a>
    <a href=../customers.php>Customers</a>
</div>
<body>
<div class ="mainArea">
<h2>
    Admin Manager
</h2>

<?php
$userID = $_POST["username"];

if($_POST["action"]=="Remove")
{
    include('deleteAdmin.php');
}
else if($_POST["action"]=="Add Admin")
{
    include('addAdmin.php');
}
else
{
    echo "ERROR";
}
?>

<br>

<form action="/TestFiles/pizzaOrderServerside/admins.php">
    <input type="submit" name="action" value="Go Back"/>
</form>

</body>
</html>

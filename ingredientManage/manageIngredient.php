<!DOCTYPE HTML>
<html>
<head>
    <title>
        PPPP Ingredients
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
    <a class = "active" href=../ingredients.php>Ingredients</a>
    <a href=../notifications.php>Notifications</a>
    <a href=../admins.php>Admins</a>
    <a href=../customers.php>Customers</a>
</div>
<body>
<div class ="mainArea">
<h1>
    Ingredients Manager
</h1>

<?php
$id = $_POST["id"];

if($_POST["action"]=="Modify")
{
    include('editIngredient.php');
}
else if($_POST["action"]=="Remove")
{
    include('deleteIngredient.php');
}
else if($_POST["action"]=="Add New Ingredient")
{
    include('addIngredient.php');
}
else
{
    echo "ERROR";
}
?>

<br>

<form action="/TestFiles/pizzaOrderServerside/ingredients.php">
    <input type="submit" name="action" value="Go Back"/>
</form>
</div>
</html>

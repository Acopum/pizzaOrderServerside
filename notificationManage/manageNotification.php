<!DOCTYPE HTML>
<html>
<head>
    <title>
        PPPP Notifications
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
    <a class = "active" href=../notifications.php>Notifications</a>
    <a href=../admins.php>Admins</a>
    <a href=../customers.php>Customers</a>
</div>
<body>
<div class ="mainArea">
    <h2>
        Notifications Manager
    </h2>

<?php
    $id = $_POST["id"];

    if($_POST["action"]=="Edit")
    {
        include('editNotification.php');
    }
    else if($_POST["action"]=="Delete")
    {
        include('deleteNotification.php');
    }
    else if($_POST["action"]=="Assign")
    {
        include('assignNotification.php');
    }
    else if($_POST["action"]=="Add New Notification")
    {
        include('addNotification.php');
    }
    else
    {
        echo "ERROR";
    }
?>

    <br>

    <form action="/TestFiles/pizzaOrderServerside/notifications.php">
        <input type="submit" name="action" value="Go Back"/>
    </form>
</div>
</body>
</html>

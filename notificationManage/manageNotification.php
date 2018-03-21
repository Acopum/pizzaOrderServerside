<!DOCTYPE HTML>
<html>
<head>
    <title>
        PPPP Notifications
    </title>
</head>
<style>
    th, td {
        border: 1px solid black;
    }
</style>
<body>
    <h1>
        Notifications Manager
    </h1>

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

</body>
</html>

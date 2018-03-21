<!DOCTYPE HTML>
<html>
<!-- Orders -->
<head>
    <title>
        PPPP Orders
    </title>
</head>
<style>
    th, td {
        border: 1px solid black;
    }
</style>
<body>
<h1>
    Order Manager
</h1>

<?php
$id = $_POST["id"];

if($_POST["action"]=="Remove")
{
    include('deleteOrder.php');
}
else if($_POST["action"]=="Edit")
{
    include('editOrder.php');
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

</body>
</html>

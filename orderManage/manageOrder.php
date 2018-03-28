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

</body>
</html>

<!DOCTYPE HTML>
<html>
<head>
    <title>
        PPPP Items
    </title>
</head>
<style>
    th, td {
        border: 1px solid black;
    }
</style>
<body>
<h1>
    Item Manager
</h1>

<?php
$id = $_POST["id"];
$type = $_POST["type"];
$orderID = $_POST["order"];

if($type == 'Pizza'){
    if($_POST["action"]=="View Item")
    {
        include('pizzaManage/viewPizza.php');
    }
    else if($_POST["action"]=="Edit Item")
    {
        include('pizzaManage/editPizza.php');
    }
    else if($_POST["action"]=="Remove Item")
    {
        include('pizzaManage/deletePizza.php');
    }
    else if($_POST["action"]=="Add New Pizza")
    {
        include('pizzaManage/addPizza.php');
    }
    else
    {
        echo "ERROR, BAD ACTION";
    }
}
else
{
    echo "ERROR, BAD TYPE";
}
?>

<br>

<?php
    echo "<form method=\"post\" action=\"/TestFiles/pizzaOrderServerside/orderManage/manageOrder.php\">
        <input type=\"submit\" name=\"actiontext\" value=\"Go Back\" />
        <input type=\"hidden\" name=\"id\" value=$orderID />
        <input type=\"hidden\" name=\"action\" value=\"View Contents\" />
    </form>";
?>

</body>
</html>
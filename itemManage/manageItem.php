<!DOCTYPE HTML>
<html>
<head>
    <title>
        PPPP Items
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
    Item Manager
</h2>

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
</div>
</body>
</html>
<!DOCTYPE HTML>
<html>
<head>
    <title>
        PPPP Ingredients
    </title>
</head>
<style>
    th, td {
        border: 1px solid black;
    }
</style>
<body>
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

</body>
</html>

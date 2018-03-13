<!DOCTYPE HTML>
<html>
<!-- Admins -->
<head>
    <title>
        PPPP Admins
    </title>
</head>
<style>
    th, td {
        border: 1px solid black;
    }
</style>
<body>
<h1>
    Admin Manager
</h1>

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

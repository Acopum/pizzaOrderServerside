<!DOCTYPE HTML>
<html>
<head>
    <title>
        PPPP Orders
    </title>
</head>
<body>
<style>
    th, td {
        border: 1px solid black;
    }
</style>
<h1>
    Ingredients Manager
</h1>

<p>
    This menu allows you to manage ingredients.
</p>

<?php
//log in for server
$server = "192.168.194.154";
$port = "3306";
$username = "user";
$password = "papa-pizza";
$dbname = "pizzaorderapp";

//create connection to DB
$connection = new mysqli($server, $username, $password, $dbname, $port);

//test connection
if($connection->connect_error)
{
    die("Connection failure. Error code: ".$connection->connect_error);
}

//store queries in variable
$selectIng = "SELECT * FROM ingredients ";

//store results
$ingredients = $connection->query($selectIng);
?>

<table>
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Cost</td>
        <td>Size</td>
        <td>Type</td>
        <td>Calorie Content</td>
        <td>Available Actions</td>
    </tr>

    <?php
    //run through table and populate info page
    if($ingredients->num_rows > 0){
        while($row=$ingredients->fetch_assoc()){
            echo "<tr>";

            $id = $row["ing_id"];

            //rows filled from DB
            echo "<td>".$id."</td>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>$".$row["cost"]."</td>";
            echo "<td>".$row["weight"]."g</td>";
            echo "<td>".$row["type"]."</td>";
            echo "<td>".$row["calories"]." Cal</td>";

            //action buttons
            echo "<td><form method=\"post\" action=\"ingredientManage\manageIngredient.php\">
                           <input type=\"submit\" name=\"action\" value=\"Modify\"/>
                           <input type=\"submit\" name=\"action\" value=\"Remove\"/>
                           <input type=\"hidden\" name=\"id\" value=$id />
                      </form></td>";

            echo "<tr>";
        }
    }
    //if empty
    else{
        echo " No ingredients found.";
    }
    ?>

</table>
<br>

<form method="post" action="ingredientManage\manageIngredient.php">
    <input type="submit" name="action" value="Add New Ingredient"/>
</form>

<form action="ParetoMainMenu.php">
    <input type="submit" name="action" value="Go Back"/>
</form>

<?php
//close connection
$connection->close();
?>

</body>
</html>
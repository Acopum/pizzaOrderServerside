<?php

$orderID = $id;

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
$selectQuery = "SELECT * FROM order_items WHERE order_number=$orderID";

//store results
$contents = $connection->query($selectQuery);
?>

        <?php
		
        //run through table and populate info page
        if($contents->num_rows > 0){

            echo "<table>
                    <tr>
                        <td>Item Category</td>
                        <td>Item ID</td>
                        <td>Available Actions</td>
                    </tr>";

            while($row=$contents->fetch_assoc()){
                echo "<tr>";

                $id = $row["item_id"];
                $type = $row["type"];

                //rows filled from DB
                echo "<td>".$type."</td>";
                echo "<td>".$id."</td>";

                //action buttons
                echo "<td><form method=\"post\" action=\"\TestFiles\pizzaOrderServerside\itemManage\manageItem.php\">
                           <input type=\"submit\" name=\"action\" value=\"View Item\"/>
                           <input type=\"submit\" name=\"action\" value=\"Edit Item\"/>
                           <input type=\"submit\" name=\"action\" value=\"Remove Item\"/>
                           <input type=\"hidden\" name=\"id\" value=$id />
                           <input type=\"hidden\" name=\"type\" value=$type />
                           <input type=\"hidden\" name=\"order\" value=$orderID />
                      </form></td>";

                echo "<tr>";
            }
        }
        //if empty
        else{
            echo " No items found.";
        }
        ?>

    </table>
    <br>
    <?php
    echo
    "<form method=\"post\" action=\"\TestFiles\pizzaOrderServerside\itemManage\manageItem.php\">
        <input type=\"submit\" name=\"action\" value=\"Add New Pizza\"/>
        <input type=\"hidden\" name=\"type\" value=\"Pizza\" />
        <input type=\"hidden\" name=\"order\" value=$orderID />
    </form>";

//close connection
$connection->close();
?>
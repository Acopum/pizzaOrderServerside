<?php
//notification ID comes from last page
$idno = $id;

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

//if submit has been used
if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["subUsed"]==1){

    $specifiedUser = $_POST['userSelect'];
    $specifiedPromoNo = $_POST['promoNum'];

    if(empty($specifiedUser))
    {
        echo "No users selected.";
    }
    else
    {
        $numberUsers = count($specifiedUser);

        for($i=0; $i<$numberUsers;$i++)
        {
            $newPromoNumber = $specifiedPromoNo[$i]+1;

            //store update query in variable
            $insertQuery = "INSERT INTO assign_promotion (username, promoID) VALUES (' $specifiedUser[$i]', $idno)";

            if($connection->query($insertQuery) == TRUE)
            {
                $updateQuery = "UPDATE user_accounts SET promotions=$newPromoNumber WHERE username = '$specifiedUser[$i]'";
                $updatePromo = $connection->query($updateQuery);
            }

            echo "Notification assigned.";
        }
    }
}

//store select queries in variable
$selectQuery = "SELECT date, notification_type, messages FROM promotions WHERE number = $idno";

//store results in variables
$selectNotification = $connection->query($selectQuery);

?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">


            <?php

            echo "<input type=\"hidden\" name=\"subUsed\" value=0 />";

            if($selectNotification->num_rows > 0){

                echo "<table>
                        <tr>
                            <th></th>
                            <th>Notification Data</th>
                        </tr>";

                while($row=$selectNotification->fetch_assoc()){
                    //store queried row in variables for ease of use
                    $type =$row["notification_type"];
                    $date =$row["date"];
                    $content =$row["messages"];

                    echo "<tr>";
                    echo "<td>ID</td>";
                    echo "<td>$idno</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Date</td>";
                    echo "<td>$date</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Type</td>";
                    echo "<td>$type</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Content</td>";
                    echo "<td>$content</td>";
                    echo "</tr>";

                    //store action, id, and whether submit is used
                    echo "<input type=\"hidden\" name=\"action\" value=\"Assign\" />";
                    echo "<input type=\"hidden\" name=\"id\" value=$idno />";
                    echo "<input type=\"hidden\" name=\"subUsed\" value=1 />";
                }
            }
            else{
                echo "No notification found!";
            }
            ?>

        </table>
        <br>

        <?php
        //store queries in variable
        $selectCustomer = "SELECT * FROM user_accounts WHERE privledge = 'customer' ";

        //store results
        $customers = $connection->query($selectCustomer);
        ?>

        <table>
            <tr>
                <td>Customer Username</td>
                <td>Active Notifications</td>
                <td>Assign Notification</td>
            </tr>

            <?php
            //run through table and populate info page
            if($customers->num_rows > 0){
                while($row=$customers->fetch_assoc()){
                    echo "<tr>";

                    $user = $row["username"];
                    $notno = $row["promotions"];

                    //rows filled from DB
                    echo "<td>".$user."</td>";
                    echo "<td>".$notno."</td>";
                    echo "<td><input type=\"checkbox\" name= \"userSelect[]\" value=$user></td>";
                    echo "<input type=\"hidden\" name=\"promoNum[]\" value=$notno />";
                    echo "<tr>";
                }
            }
            //if empty
            else{
                echo " No notifications found.";
            }
            ?>

        </table>

        <br>
        <input type="submit" value="Submit">
    </form>

<?php
//close connection
$connection->close();
?>
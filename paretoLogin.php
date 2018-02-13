<!DOCTYPE HTML>
<html>
<!-- Login for Admin-->
<head>
    <title>
        PPPP Login
    </title>
</head>
<body>
<h1>
    Administrator Login
</h1>

<?php
    //clean submitted data for dangerous characters
    function clean_login($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <div class="container">
        <label><b>Username:</b></label>
        <input type="text" placeholder="" name="username" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="" name="password" required>

        <button type="submit">Login</button>
    </div>
</form>

<?php
    $user = $password = "";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $user = clean_login($_POST["username"]);
        $pass = clean_login($_POST["password"]);

        //log in for actual server
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
        $sql_check = "SELECT password FROM user_accounts WHERE username = '$user'";

        //store results in variable
        $sqlpass = $connection->query($sql_check);

        //retrieve first row of query
        if($sqlpass->num_rows > 0) {
            while ($retrieveDB = $sqlpass->fetch_assoc()) {

                //check credentials
                if ($pass == $retrieveDB["password"]) {
                    header("Location: ParetoMainMenu.php");
                    exit();
                }
                else {
                    echo "Login credentials invalid. Please try again.";
                }
            }
        }
        else{
            echo "Username not recognized.";
        }
    }
?>

</body>
</html>
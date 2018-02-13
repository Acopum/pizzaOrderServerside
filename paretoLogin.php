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
    $username = $password = "";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $username = clean_login($_POST["username"]);
        $password = clean_login($_POST["password"]);

        /*
        //log in for actual server
        $server = "192.168.194.154";
        $port = "3306";
        $username = "";
        $password = "";
        $dbname = "";


        //create connection to DB
        $connection = new mysqli($server, $username, $password, $dbname, $port);

        //test connection
        if($connection->connect_error)
        {
            die("Connection failure. Error code: ".$connection->connect_error);
        }

        //store queries in variable
        $sql_check = "SELECT pass FROM login WHERE username = $username";

        //store results in variable
        $sqlpass = $connection->query($sql_check);

        //retrieve first row of query
        $retrieveDB=$sqlpass->fetch_assoc()

        //check credentials
        if ($password == $retrieveDB["pass"])
        {
            header("Location: ParetoMainMenu.php");
            exit();
        }
        else
        {
            echo "Login credentials invalid. Please try again.";
        }
        */

        //check credentials
        if ($username == "admin" && $password =="pass")
        {
            header("Location: ParetoMainMenu.php");
            exit();
        }
        else
        {
            echo "Login credentials invalid. Please try again.";
        }
    }
?>

</body>
</html>
<!DOCTYPE HTML>
<html>
<head>
    <title>
        PPPP Login
    </title>
    <link rel="stylesheet" type="text/css" href="styleSheets/loginPage.css">
</head>
<body>
<div class="banner">
    <h1>
        ADMINISTRATOR LOGIN
    </h1>
</div>
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
    <div class = "imgContainer">
        <img src="images/italiaBoromito.png" alt="deep-normified meme">
    </div>
    <div class="inputFields">
        <label><b>Username</b></label>
        <input type="text" name="username" required>
        <label><b>Password</b></label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </div>
</form>
<div class="messages">
<?php
    $user = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        if ($connection->connect_error) {
            die("Connection failure. Error code: " . $connection->connect_error);
        }

        //store queries in variable
        $sql_login = "SELECT * FROM user_login WHERE username = '$user'";

        //store results in variable
        $sqlLogin = $connection->query($sql_login);

        //retrieve first row of query
        if ($sqlLogin->num_rows > 0) {
            while ($loginInfo = $sqlLogin->fetch_assoc()) {

                $numFails=$loginInfo["login_attempt_num"];
                $lastLogin=$loginInfo["last_login_attempt"];

                //store queries in variable
                $sql_check = "SELECT password, salt FROM user_accounts WHERE username = '$user'";

                //store results in variable
                $sqlpass = $connection->query($sql_check);



                if($sqlpass->num_rows>0){
                        $retrieveDB = $sqlpass->fetch_assoc();
                        if($numFails == 3)
                        {
                            if((time()-$lastLogin) > 10*60 )
                            {
                                $numFails = 0;
                            }
                            else
                            {
                                echo "Login block. Please wait 10 minutes before trying again.";
                                exit();
                            }
                        }

                        //check credentials
                        if (md5($pass.$retrieveDB["salt"]) == $retrieveDB["password"]) {

                            $numFails = 0;
                            $updateLogin = "UPDATE user_login SET login_attempt_num=$numFails, last_login_attempt=$lastLogin WHERE username = '$user'";
                            $connection->query($updateLogin);

                            header("Location: ParetoMainMenu.php");
                            exit();

                        }
                        else{
                            echo "Incorrect password.";
                            $numFails++;
                            $lastLogin = time();

                            $updateLogin = "UPDATE user_login SET login_attempt_num=$numFails, last_login_attempt=$lastLogin WHERE username = '$user'";
                            $connection->query($updateLogin);
                        }

                }
                else {
                    echo "No login information found.";
                }
            }
        }
        else{
            echo "Username not recognized.";
        }

    }
?>
</div>
</body>
</html>
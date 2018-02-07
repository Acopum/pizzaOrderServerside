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
$username = $password = "";

function clean_login($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="container">
        <label><b>Username:</b></label>
        <input type="text" placeholder="" name="username" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="" name="password" required>

        <button type="submit">Login</button>
    </div>
</form>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = clean_login($_POST["username"]);
    $password = clean_login($_POST["password"]);

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
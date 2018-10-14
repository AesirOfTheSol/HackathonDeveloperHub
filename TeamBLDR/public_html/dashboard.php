<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/14/2018
 * Time: 5:34 AM
 * Project: TeamBLDR
 */


$username;

if (isset($_COOKIE['user']))
{
    $username = $S_COOKIE['user'];
} else if(isset$_SESSION['user'])
{
    $username = $S_COOKIE['user'];
}
else die;

echo <<<_END
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles/Navbar.css" media="screen" type="text/css">
    <link rel="stylesheet" href="styles/Navbar.css" media="screen" type="text/css">
</head>
<body style="background-color: #d7d7d7">
    <div class="navbar">
        <img src="resources/logo-sm.png" alt="logo" class="pic">
        <a class="active" href="#">Dashboard</a>
        <a class="option" href="DevProfile.php">Developer Profile</a>
        <a class="option" href="#">My Projects</a>
        <a class="logout" href="logout.php">Logout</a>
        <a class="user">$loggedinuser</a>

    </div>



    <div class="node">

    </div>
</body>
</html>
_END;






?>
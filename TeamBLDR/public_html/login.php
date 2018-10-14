<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/13/2018
 * Time: 2:49 AM
 * Project: HackUMass2018
 *
 *
 * Look, I know this is the most janky-ass login you've ever seen. But I am running out of time and barely started working
 * on the features of the webpage. Bear with it. I'll fix it in a patch after the hackathon.
 *
 *
 *
 * Yes that also means I'll block sql injections...
 */

session_start();
require_once '../../data_files/DatabaseConnection.php';

//Variables
$loginMessage;          //variable holds message to display below login button in case login attempt was unsuccessful.
$authenticator = $_GET['auth'];         //This argument only gets filled if the call to logmein.php  was successful.
$email = $_GET['email'];
$password = $_GET['password'];
$username;

//Begin by validating the inputs

//Check to see if there was a failed login attempt. Update the webpage accordingly.
if (isset($_GET['auth']))       //If there was a login attempt.
{
    if($_GET['auth'] = true)        //If an attempt was successful
    {
        header('Location: dashboard.html');
    }
    else                        //If the attempt failed.
    {
        $loginMessage = "Please enter the correct information!";
    }
}


//Check the database for the username and pass
$query = "SELECT u_name, password FROM Users WHERE e_mail='$email';";
$res = dbquery($query);
$row =$res->fetch_object();
$usernameMatches = false;
$passwordMatches = false;


$dbusername = $row->uname;      //holds the username from the database


if ($dbusername == $username)   //if there is a username in the database that matches the passed arg
{
    $usernameMatches = true;
}

//Get the currently stored password hash in the database
$query = "SELECT password FROM Users WHERE e_mail='$email';";
$res = dbquery($query);
$row = $res->fetch_object();
$dbpass = $row->password;       //holds the password from the database
if (password_verify($password, $dbpass))   //If the passwords match
{
    $passwordMatches = true;
}

if ($usernameMatches && $passwordMatches)
{
    $query = "SELECT u_id FROM Users WHERE e_mail='$email';";
    $res = dbquery($query);
    $row = $res->fetch_object();
    $_SESSION["userID"] = $row->u_id;
    $_SESSION["auth"] = true;       //authorized to go in.
    setcookie("user", $_SESSION['userID'],time()+2567800);
    header('Location: dashboard.html');      //brings user to the dashboard.
}




//Start HTML building
echo <<<_END
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Developer Hub Login</title>
    <link rel="stylesheet" href="styles/styles.css" media="screen" type="text/css">
    
</head>
<body style="background-color: #D7D7D7">
<center>
<div class="main">
    <div class="projTitle">
        <h1>TEAM<br>BLDR</h1>
    </div>
        <h1>Welcome!</h1>
        <h3>Please Sign in below</h3>

        <form action="login.php">
            <table>
                <tr>
                    <td>E-mail address:</td>
                    <td><input name="email" type="text" autofocus="autofocus"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input name="password" type="password" value=""></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2"><input name="submit" type="submit" value="Log In" ></td>
                </tr>
            </table>
        </form>
        <form action="createAccount.php?success=false">
            <table>
                <tr>
                    <td colspan="2"><button onclick="location.href='createAccount.php?success=false';">No Account?</button></td>
                </tr>
                <tr>
                    <td colspan="2"><p><fontcolor="red">$loginMessage</font></p></td>
                </tr>
            </table>
        </form>
</div>
</center>
</body>
</html>

_END;


//ending html tags



?>
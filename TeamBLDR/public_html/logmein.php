<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/13/2018
 * Time: 2:37 AM
 */

require_once 'DatabaseConnection.php';

session_start();

//Get e-mail and password from URL

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];

//Check the database for the username and pass
$query = "SELECT * FROM Users WHERE e_mail='$email';";
$res = dbquery($query);
$row =$res->fetch_object();
$usernameMatches = false;
$passwordMatches = false;

if ($row)   //if there is a username in the database that matches the passed arg
{
    $usernameMatches = true;
}

//Get the currently stored password hash in the database
$query = "SELECT password FROM Users WHERE e_mail='$email';";
$res = dbquery($query);
$row = $res->fetch_object();
if (password_verify($password, $res->password))   //If the passwords match
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
    header('Location: dashboard.php');      //brings user to the dashboard.
}




//sql injection-proof it



?>


















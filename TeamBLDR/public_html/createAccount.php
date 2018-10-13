<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/13/2018
 * Time: 6:01 AM
 * Project: HackUMass2018
 */

require_once '../../data_files/DatabaseConnection.php';
/*
 * This file is the create account interface.
 */
//Variables
$stringMessage = "";
$success;                 //stores whether or not an account was successfully created.
$email = $_GET["email"];
$username = $_GET["uname"];
$firstname = $_GET["fname"];
$lastname = $_GET["lname"];
$firstPassword = $_GET["pass0"];
$secondPassword = $_GET["pass1"];
//If an argument for success was not passed
if (!isset($_GET["success"]))
{
    $success = false;       //set success variable equal to false.
}
if ($_GET["success"] == "true") $success = true;
if (S_REQUEST["success"] == "false") $success = false;
if ($success == true)       //if a form was just submitted correctly
{
    header("Location: login.php");      //route them into
}

//Queries for data validation.
$query = "SELECT u_id FROM Users WHERE e_mail='$email';";
$res = dbquery($query);
$row = $res->fetch_object();
print("Query for email result: $row->e_mail");
//data validation
if(!isset($_GET["email"], $_GET["uname"], $_GET["fname"], $_GET["lname"], $_GET["pass0"], $_GET["pass1"]))      //If all of the forms are empty.
{
    $stringMessage = "Please fill out the form.";
} else if(true)         //if the email already exists in the database.



//check in the server for if the user already exists

if ($row->u_id === null)          //If he doesn't exist
{
    echo "<p>He doesn't exist! $row->u_id</p>";
}
else if($row->u_id !==null)
{
    $stringMessage = "Account already created with this e-mail. Only one account per person.";
}

//If the passwords DO NOT MATCH
if (!passwordMatches($firstPassword, $secondPassword))
{
    $stringMessage = "Sorry, please make sure your passwords match!";
}


//encrypt the password.
$hashedPassword = password_hash($firstPassword, PASSWORD_DEFAULT);

//This is where the query happens
if (isset($_GET['email'], $_GET['uname'], $_GET['fname'], $_GET['lname'], $_GET['pass0'], $_GET['pass1'])) {
    $query = "INSERT INTO Users SET u_name='$username', f_name='$firstname', l_name='$lastname', e_mail='$email', password='$hashedPassword';";
    $res = dbquery($query);     //execute the query, store results.
    $success = true;
}
//header('Location: createAccount.php?success=true');


//Once the query happens, check to make sure it was added

//html build the forms
echo <<<_END
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8";>
    <title>Create an Account</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
<center>

<div class="main">
    <div class="projTitle">
        <h1>TEAM<br>BLDR</h1>
    </div>
        <h1>Create an Account</h1>
        <h3>Fill out the information below to sign up!</h3>
        <form action="createAccount.php">
            <table>
                <tr>
                    <td class="inputdesc">E-mail address: </td>
                    <td><input name='email' type="email" autofocus="autofocus"></td>
                </tr>
                <tr>
                    <td class="inputdesc">First Name: </td>
                    <td><input name="fname" type="text"></td>
                </tr>
                <tr>
                    <td class="inputdesc">Last Name: </td>
                    <td><input name="lname" type="text" ></td>
                </tr>
                <tr>
                    <td class="inputdesc">Password: </td>
                    <td><input name="pass0" type="password"></td>
                </tr>
                <tr>
                    <td class="inputdesc">Re-type Password: </td>
                    <td><input name="pass1" type="password"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="Submit" value="Create Account"</td>
                </tr>
                <tr>
                    <td colspan="2"><p class="warningMessage"><fontcolor="red">$stringMessage</p></td>
                </tr>
            </table>
        </form>

</div>
</center>
</body>
</html>
    


_END;


/**
 * Function simply compares the two passwords and returns whether or not they're correct.
 * @param $firstPassword
 * @param $secondPassword
 * @return bool
 */
function passwordMatches($firstPassword, $secondPassword)
{
    if ($firstPassword === $secondPassword)
    {
        return true;
    }
    else
    {
        false;
    }

}

?>
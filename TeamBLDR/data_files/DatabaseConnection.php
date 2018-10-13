<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/13/2018
 * Time: 2:47 AM
 * Project: HackUMass2018
 */

$dbhost = "localhost";
$dbuser = "S0307147";
$dbpass = "M0tta3802m1#";
$dbname = $dbuser;


$dbcon = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($dbcon->connect_error)
{
    die($dbcon->connect_error);
}

function dbquery($query)
{
    global $dbcon;
    $result = $dbcon->query($query);
    if (!$result) die ("$query error: $dbcon->error");
    return $result;
}

function dbescape($s)
{
    global $dbcon;
    return $dbcon->real_escape_string($s);
}





?>
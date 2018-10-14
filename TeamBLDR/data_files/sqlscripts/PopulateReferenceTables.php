<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/14/2018
 * Time: 12:21 AM
 * Project: TeamBLDR
 */

require_once '../DatabaseConnection.php';

$languages = array("C", "C++", "C#", "Java", "Javascript", "php", "HTML",
    "CSS", "Python", "Ruby");

$api = array("Google Maps",  "DJango", "Twitter", "Twillio");

$Category = array("Hardware Hack", "Android Development", "Web Design", "Web Development",
    "iOS Development");

for ($i = 0; $i < count($languages); $i++)
{
    $query = "INSERT INTO Languages SET lang='$languages[$i]';";
    $res = dbquery($query);
}

for ($i = 0; $i < count($api); $i++)
{
    $query = "INSERT INTO API SET api='$api[$i]';";
    $res = dbquery($query);
}

for ($i = 0; $i < count($Category); $i++)
{
    $query = "INSERT INTO Category SET cat='$Category[$i]';";
    $res = dbquery($query);
}




?>
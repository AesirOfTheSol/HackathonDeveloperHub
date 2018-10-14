<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/13/2018
 * Time: 4:23 PM
 * Project: HackUMass2018
 */

/**
 * This code is strictly to add a single entry to the empty table. Run this after CreateTables.mysql
 */

require_once '../../data_files/hackathon/DatabaseConnection.php';

/*
 * Generate a password
 */

$mypassword = "Password!";
$hashedPassword = password_hash($mypassword, PASSWORD_DEFAULT);

$query = "INSERT INTO Users SET u_name='Solafarus', f_name='Nicholas', l_name='Motta', e_mail='n_motta1@salemstate.edu', password='$hashedPassword'";
$res = dbquery($query);
print($res);


?>
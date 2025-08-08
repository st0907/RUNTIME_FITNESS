<?php
/*Programmer Name: SIM TIAN (TP077056)
Program Name: config.php
Description: Link the php to the database sim
First Written on: Wednesday, 18-June-2025
*/
$con = new mysqli("localhost", "root", "", "sim2");

if ($con->connect_error) {
    die("Failed to connect to database: " . $con->connect_error);
}
?>

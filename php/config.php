<?php
$serverHostname = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "natix";

$dbConnection = new mysqli($serverHostname, $dbUsername, $dbPassword, $dbName);

if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
}
?>
<?php
// The database config file and connection
// You must change this in order to work

$hostname = "127.0.0.1";
$user = "root";
$password = ""; // It's my dev server, don't blame me for this NO password
$database = "eggplant";

// Creating the conection via new mysqli
$conn = new mysqli($hostname, $user, $password, $database);

// Test if works
if ($conn -> connect_error) {
  // If not, send an error
  die ("There's a problem with your database connection: ". $conn -> connect_error);
}

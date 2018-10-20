<?php
// Get all items

// First, load the config
include_once "databaseconfig.php";

// Next, the query with the default order
$sql = "SELECT * FROM data ORDER BY name ASC, email ASC";

// Do the query
$result = $conn -> query($sql);

// Create the array variable where to store all the response
$databaseResponse = array();

if ($result -> num_rows > 0) {
  // If there's something
  while ($row = $result -> fetch_assoc()) {
    // Create a temporal one
    $tmparray = array(
      "name" => $row["name"],
      "dateBird" =>  $row["dateBird"],
      "email" =>  $row["email"],
      "numberChildren" => $row["numberChildren"]
    );
    // Then push to the response array
    array_push($databaseResponse, $tmparray);
  }
}

// Send to the browser

// First, set the headers
header("Access-Control-Allow-Origin: *"); // I always add the acces from everyplace but you can comment it
header('Content-Type: application/json');

// Now the response
echo json_encode($databaseResponse);

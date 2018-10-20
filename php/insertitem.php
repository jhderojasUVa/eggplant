<?php
// Insert an item into the database
include_once "databaseconfig.php";

// First take the input
$inputData = json_decode(trim(file_get_contents("php://input")), true);

// What I'm doing this?
// Easy there must be double check on the data:
// first on the client via JS
// second on the server via... on this case PHP
$name = $inputData["name"];
$datebird = $inputData["dateBird"];
$email = $inputData["email"];
$numberChildren = $inputData["numberChildren"];

// One variable for the errors and the other for the response
$isErrors = array();
$theResponse = array();

// Let's check the name or email size don't exceeds the db limit
if (strlen($name) > 250 || strlen($email) > 250) {
    if (strlen($name) > 250) {
      // The error menssage
      array_push($isErrors, "There's an error", "Field name is too big");
    }
    if (strlen($email) > 250) {
      // The error menssage
      array_push($isErrors, "There's an error", "Field email is too big");
    }
}
// Now let's check if email is an email by searching an @ and a .
if (strpos($email, "@") == false) {
  // The error menssage
  array_push($isErrors, "There's an error", "Field email is not correct");
}

// If all it's ok lets insert into the database
if (sizeof($isErrors) > 0) {
  // If there's errors we send the errors to the client :)
  array_push($isErrors, "error", "true");
} else {
  $sql = "INSERT INTO data (name, dateBird, numberChildren, email) VALUES ('". $name ."', '". $datebird ."', '". $numberChildren ."', '". $email ."')";

  // Do the insert query
  $result = $conn -> query($sql);
  array_push($isErrors, $result);
  array_push($isErrors, "error", "false");
}

// Encoding the response
$theResponse = json_encode($isErrors);

// Send the response
// First, set the headers
header("Access-Control-Allow-Origin: *"); // I always add the acces from everyplace but you can comment it
header('Content-Type: application/json');

// Now the response
echo json_encode($theResponse);

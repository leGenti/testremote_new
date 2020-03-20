<?php

// Required headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Get database connection

include_once '../config/Database.php';

// Instansiate Taak Object

include_once '../../Service/Taak.php';

$database = new Database();
$db = $database->getConnection();

$taak = new Taak($db);

// Get posted data

$data = json_decode(file_get_contents("php://input"));

// Make sure data is not empty


//Create taak
if($taak->create()) {
    // Set the response code - 201 Created
    http_response_code(201);

    echo json_encode(
        array('message' => 'Je hebt een taak aangemaakt.')
    );
}
// Tell the user the data is incomplete
else {
    // Set the response code - 503 Service unavailable
    http_response_code(503);

    echo json_encode(
        array('message' => 'Er is iets fout gegaan met het aanmaken van de taak!')
    );
}



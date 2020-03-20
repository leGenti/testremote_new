<?php

header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');


include_once '../config/Database.php';
include_once '../../Service/Taak.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->getConnection();

//Instantiate taak object
$taak = new Taak($db);

// Set ID property of record to read
$taak->taa_id = isset($_GET['id']) ? $_GET['id'] : die();

//GET taak
$taak->readOne();

//Create taak array
$taak_arr = array(
    'id' => $taak->taa_id,
    'datum' => $taak->taa_datum,
    'omschrijving' => $taak->taa_omschr
);

//Make JSON
print_r(json_encode($taak_arr));
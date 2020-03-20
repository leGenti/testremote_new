<?php

// Required headers

header("Acces-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Database connection will be here

include_once '../config/Database.php';
include_once '../../service/Taak.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->getConnection();

//Instantiate taak object
$taak = new Taak($db);

//Taak query
$result = $taak->read();

//Get row count
$num = $result->rowCount();

//Check if there are taken
if($num > 0) {
    //taak array
    $taak_arr = array();
    $taak_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $taak_item = array(
            'id' => $taa_id,
            'datum' => $taa_datum,
            'omschrijving' => $taa_omschr
        );

        //push to 'data'
        array_push($taak_arr['data'], $taak_item);
    }

    //Turn PHP array to JSON
    echo json_encode($taak_arr);
} else {

    // Tell the user no Taken found
    echo json_encode(
        array('message' => 'Er werden geen taken teruggevonden.')
    );
}
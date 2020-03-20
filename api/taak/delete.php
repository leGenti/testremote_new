<?php
// Required headers

header('Access-Control-Allow-Orgin: *');
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: DELETE');
header('Access-Controle-Allow-Headers: Access-Controle-Allow-Headers, Content-Type, Access-Controle-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../../Service/Taak.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->getConnection();

//Instantiate taak object
$taak = new Taak($db);

//GET raw posted data
$data = json_decode(file_get_contents('php://input'));

//Set ID to update
$taak->taa_id = $data->taa_id;

//Delete post
if($taak->delete()) {

    http_response_code(200);

    echo json_encode(
        array('message' => 'Taak is deleted')
    );
} else {

    http_response_code(503);

    echo json_encode(
        array('message' => 'Unable to delete taak')
    );
}
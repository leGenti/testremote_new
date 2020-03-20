<?php

$no_access = true;
require_once "lib/autoload.php";
require_once "acces_control.php";

$taak = new Taak($db);

//get the urlparts
$uri_parts = explode("/",$_SERVER["REQUEST_URI"]);

//count the urlparts
$count = count($uri_parts);

//divide url into different parts
$last_part = end($uri_parts);
$second_last_part = $uri_parts[$count-2];
$third_last_part = $uri_parts[$count-3];

if($count == 4 AND $last_part == 'taken') {
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $taak->read();
        return true;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $taak->create();
        return true;
    }
    else {
        echo 'unvalid request method';
        return false;
    }
}

if($count == 5 AND $second_last_part == 'taken') {
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $taak->read($last_part);
        return true;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
        $taak->update($last_part);
        return true;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        $taak->delete($last_part);
        return true;
    }
    else {
        echo 'unvalid request method';
        return false;
    }
}

if($count == 6 AND $third_last_part == 'taken' AND $second_last_part == 'date') {
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $taak->read(null, $last_part);
        return true;
    }
}

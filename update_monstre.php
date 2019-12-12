<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../database.php';
include_once '../Objects/monstre.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare monstre object
$monstre = new Monstre($db);
 
// get id of monstre to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of monstre to be edited
$monstre->id_monstre = $data->id_monstre;
 
// set monstre property values
$monstre->mons_pos_x = $data->mons_pos_x;
$monstre->mons_pos_y = $data->mons_pos_y;
$monstre->mons_pts_vie = $data->av_pts_vie;
 
// update the monstre
if($monstre->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "monstre was updated."));
}
 
// if unable to update the monstre, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update monstre."));
}
?>
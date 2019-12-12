<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../database.php';
include_once '../Objects/aventurier.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare aventurier object
$aventurier = new Aventurier($db);
 
// get id of aventurier to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of aventurier to be edited
$aventurier->id_aventurier = $data->id_aventurier;
 
// set aventurier property values
$aventurier->av_pos_x = $data->av_pos_x;
$aventurier->av_pos_y = $data->av_pos_y;
$aventurier->av_pts_vie = $data->av_pts_vie;
 
// update the aventurier
if($aventurier->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "aventurier was updated."));
}
 
// if unable to update the aventurier, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update aventurier."));
}
?>
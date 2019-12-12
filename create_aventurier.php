<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../database.php';
 
// instantiate aventurier object
include_once '../Objects/aventurier.php';
 
$database = new Database();
$db = $database->getConnection();
 
$aventurier = new Aventurier($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    /*!empty($data->id_aventurier) &&*/
    !empty($data->av_pos_x) &&
    !empty($data->av_pos_y) &&
    !empty($data->av_pts_vie)
){
 
    // set aventurier property values
    //$aventurier->id_aventurier = $data->id_aventurier;
    $aventurier->av_pos_x = $data->av_pos_x;
    $aventurier->av_pos_y = $data->av_pos_y;
    $aventurier->av_pts_vie = $data->av_pts_vie;
    //$aventurier->created = date('Y-m-d H:i:s');
 
    // create the aventurier
    if($aventurier->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "aventurier was created."));
    }
 
    // if unable to create the aventurier, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create aventurier."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create aventurier. Data is incomplete."));
}
?>
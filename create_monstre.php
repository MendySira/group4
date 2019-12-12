<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../database.php';
 
// instantiate monstre object
include_once '../Objects/monstre.php';
 
$database = new Database();
$db = $database->getConnection();
 
$monstre = new Monstre($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
//echo json_encode(var_dump($data));
 
// make sure data is not empty
if(
    /*!empty($data->id_monstre) &&*/
    !empty($data->nom_monstre) &&
    !empty($data->mons_pos_x) &&
    !empty($data->mons_pos_y) &&
    !empty($data->mons_pts_vie)
){
 
    // set monstre property values
    //$monstre->id_monstre = $data->id_monstre;
    $monstre->nom_monstre = $data->nom_monstre;
    $monstre->pos_x = $data->mons_pos_x;
    $monstre->pos_y = $data->mons_pos_y;
    $monstre->pts_vie = $data->mons_pts_vie;
    //$monstre->created = date('Y-m-d H:i:s');
 
    // create the monstre
    if($monstre->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "monstre was created."));
    }
 
    // if unable to create the monstre, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create monstre."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create monstre. Data is incomplete."));
}
?>
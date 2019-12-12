<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../database.php';
include_once '../Objects/aventurier.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare aventurier object
$aventurier = new Aventurier($db);
 
// set ID property of record to read
$aventurier->id_aventurier = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of aventurier to be edited
$aventurier->read();
 
if($aventurier->av_pos_x!=null){
    // create array
    $aventurier_arr = array(
        //"id_aventurier" =>  $aventurier->id_aventurier,
        "av_pos_x" => $aventurier->av_pos_x,
        "av_pos_y" => $aventurier->av_pos_y,
        "av_pts_vie" => $aventurier->av_pts_vie,
   );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($aventurier_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user joueur does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../database.php';
include_once '../Objects/monstre.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare monstre object
$monstre = new Monstre($db);
 
// set ID property of record to read
$monstre->id_monstre = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of monstre to be edited
$monstre->read();
 
if($monstre->nom_monstre!=null){
    // create array
    $monstre_arr = array(
        "nom_monstre" =>  $monstre->nom_monstre,
        "mons_pos_x" => $monstre->mons_pos_x,
        "mons_pos_y" => $monstre->mons_pos_y,
        "mons_pts_vie" => $monstre->mons_pts_vie,
   );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($monstre_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user joueur does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>
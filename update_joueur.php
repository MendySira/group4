<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../database.php';
include_once '../Objects/joueur.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare joueur object
$joueur = new Joueur($db);
 
// get id of joueur to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of joueur to be edited
$joueur->id_joueur = $data->id_joueur;
 
// set joueur property values
$joueur->pseudo = $data->pseudo;
$joueur->fk_joueur_partie = $data->fk_joueur_partie;
$joueur->fk_joueur_aventurier = $data->fk_joueur_aventurier;
 
// update the joueur
if($joueur->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "joueur was updated."));
}
 
// if unable to update the joueur, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update joueur."));
}
?>
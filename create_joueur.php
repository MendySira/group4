<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../database.php';
 
// instantiate joueur object
include_once '../Objects/joueur.php';
 
$database = new Database();
$db = $database->getConnection();
 
$joueur = new Joueur($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
//echo json_encode(var_dump($data));

// make sure data is not empty
if(
    /*!empty($data->id_joueur) &&*/
    !empty($data->pseudo) &&
    !empty($data->fk_joueur_partie) &&
    !empty($data->fk_joueur_aventurier)
){
 
    // set joueur property values
    //$joueur->id_joueur = $data->id_joueur;
    $joueur->pseudo = $data->pseudo;
    $joueur->fk_joueur_partie = $data->fk_joueur_partie;
    $joueur->fk_joueur_aventurier = $data->fk_joueur_aventurier;
    //$joueur->created = date('Y-m-d H:i:s');
 
    // create the joueur
    if($joueur->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "joueur was created."));
    }
 
    // if unable to create the joueur, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create joueur."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create joueur. Data is incomplete."));
}
?>
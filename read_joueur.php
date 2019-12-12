<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../database.php';
include_once '../Objects/joueur.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare joueur object
$joueur = new Joueur($db);
 
// set ID property of record to read
$joueur->id_joueur = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of joueur to be edited
$joueur->read();
 
if($joueur->pseudo!=null){
    // create array
    $joueur_arr = array(
        "id_joueur" =>  $joueur->id_joueur,
        "pseudo" => $joueur->pseudo,
        "fk_joueur_partie" => $joueur->fk_joueur_partie,
        "fk_joueur_aventurier" => $joueur->fk_joueur_aventurier
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($joueur->pseudo);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user joueur does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>
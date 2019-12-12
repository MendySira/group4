<?php
class Joueur{
	// database connection and table name
    private $conn;
    private $table_name = "joueur";

    //objects propeties
    public $id_joueur;
    public $pseudo;
    public $fk_joueur_partie;
    public $fk_joueur_aventurier;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //prendre les informations du joueur 
    function read(){
    	$requete = "SELECT
                    a.id_aventurier,j.id_joueur,j.pseudo,j.fk_joueur_partie,j.fk_joueur_aventurier
			    FROM".$this->$table_name." j
			    LEFT JOIN aventurier a
			    ON j.id_joueur = ? ";

		// prepare query statement
		$stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_joueur);

		// execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties
        $this->pseudo = $row['pseudo'];
        $this->fk_joueur_aventurier = $row['fk_joueur_aventurier'];
        $this->fk_joueur_partie = $row['fk_joueur_partie'];
    }

    function create(){
    	$query    = "INSERT INTO ".$this->table_name."
    	SET pseudo=:pseudo, fk_joueur_partie=:fk_joueur_partie, fk_joueur_aventurier=:fk_joueur_aventurier ";

    	// prepare query
        //id_joueur=:id_joueur
    	$stmt = $this->conn->prepare($query);

    	// sanitize
	    //$this->id_joueur=htmlspecialchars(strip_tags($this->id_joueur));
	    $this->pseudo=htmlspecialchars(strip_tags($this->pseudo));
	    $this->fk_joueur_partie=htmlspecialchars(strip_tags($this->fk_joueur_partie));
	    $this->fk_joueur_aventurier=htmlspecialchars(strip_tags($this->fk_joueur_aventurier));

	    // bind values
	    //$stmt->bindParam(":id_joueur", $this->id_joueur);
	    $stmt->bindParam(":pseudo", $this->pseudo);
	    $stmt->bindParam(":fk_joueur_partie", $this->fk_joueur_partie);
	    $stmt->bindParam(":fk_joueur_aventurier", $this->fk_joueur_aventurier);

	    // execute query
	    if($stmt->execute()){
	        return true;
	    }
	 
	    return false;   
    	
    }

    function update(){
     
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    
                    pseudo = :pseudo,
                    fk_joueur_partie = :fk_joueur_partie,
                    fk_joueur_aventurier = :fk_joueur_aventurier
                WHERE
                    id_joueur = :id_joueur";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        
        $this->pseudo=htmlspecialchars(strip_tags($this->pseudo));
        $this->fk_joueur_partie=htmlspecialchars(strip_tags($this->fk_joueur_partie));
        $this->fk_joueur_aventurier=htmlspecialchars(strip_tags($this->fk_joueur_aventurier));
        $this->id=htmlspecialchars(strip_tags($this->id));
     
        // bind new values
        
        $stmt->bindParam(':pseudo', $this->pseudo);
        $stmt->bindParam(':fk_joueur_partie', $this->fk_joueur_partie);
        $stmt->bindParam(':fk_joueur_aventurier', $this->fk_joueur_aventurier);
        $stmt->bindParam(':id_joueur', $this->id);
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }

    // delete the product
    function delete(){
     
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
     
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;         
    }

    // used for paging products
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        return $row['total_rows'];
    }


}

?>
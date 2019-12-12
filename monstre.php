<?php
/**
 * 
 */
class Monstre
{
	private $conn;
    private $table_name = "monstre";

    public $id_monstre;
    public $nom_monstre;
    public $mons_pos_x;
    public $mons_pos_y;
    public $mons_pts_vie;

	
	public function __construct($db)
	{
		$this->conn = $db;
	}

	function create(){
    	$query    = "INSERT INTO ".$this->table_name."
    	SET nom_monstre=:nom_monstre, mons_pos_x=:mons_pos_x, mons_pos_y=:mons_pos_y, mons_pts_vie=:mons_pts_vie ";

    	// prepare query
    	$stmt = $this->conn->prepare($query);

    	// sanitize
	    //$this->id_joueur=htmlspecialchars(strip_tags($this->id_joueur));
	    $this->nom_monstre=htmlspecialchars(strip_tags($this->nom_monstre));
	    $this->mons_pos_x=htmlspecialchars(strip_tags($this->mons_pos_x));
	    $this->mons_pos_y=htmlspecialchars(strip_tags($this->mons_pos_y));
        $this->mons_pts_vie=htmlspecialchars(strip_tags($this->mons_pts_vie));

	    // bind values
	    //$stmt->bindParam(":id_joueur", $this->id_joueur);
	    $stmt->bindParam(":nom_monstre", $this->nom_monstre);
	    $stmt->bindParam(":mons_pos_x", $this->mons_pos_x);
	    $stmt->bindParam(":mons_pos_y", $this->mons_pos_y);
        $stmt->bindParam(":mons_pts_vie", $this->mons_pts_vie);

	    // execute query
	    if($stmt->execute()){
	        return true;
	    }	 
	    return false;	         
	} 

	function read(){
		$query = "SELECT nom_monstre, mons_pos_x, mons_pos_y, mons_pts_vie FROM".$this->table_name."WHERE id_aventurier = ?";

		// prepare query statement
		$stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_monstre);

		// execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties
        $this->nom_monstre = $row['nom_monstre'];
        $this->mons_pos_x = $row['mons_pos_x'];
        $this->mons_pos_y = $row['mons_pos_y'];
        $this->mons_pts_vie = $row['mons_pts_vie'];
	}

	function update(){
		// update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    
                    mons_pos_x = :pos_x,
                    mons_pos_y = :pos_y,
                    mons_pts_vie = :pts_vie
                WHERE
                    id_monstre = :id_monstre";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
	    $this->id_monstre=htmlspecialchars(strip_tags($this->id_monstre));
	    $this->pos_x=htmlspecialchars(strip_tags($this->pos_x));
	    $this->pos_y=htmlspecialchars(strip_tags($this->pos_y));
	    $this->pts_vie=htmlspecialchars(strip_tags($this->pts_vie));

	    // bind new values
	    $stmt->bindParam(':id_monstre', $this->id_monstre);
        $stmt->bindParam(':pos_x', $this->pos_x);
        $stmt->bindParam(':pos_y', $this->pos_y);
        $stmt->bindParam(':pts_vie', $this->pts_vie);

        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
	}
}
?>
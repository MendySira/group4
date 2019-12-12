<?php
class Aventurier{
	// database connection and table name
    private $conn;
    private $table_name = "aventurier";

    public $id_aventurier;
    public $av_pos_x;
    public $av_pos_y;
    public $av_pts_vie;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function create(){
    	// query to insert record
	    $query = "INSERT INTO" . $this->table_name . " 
	    SET av_pos_x=:av_pos_x, av_pos_y=:av_pos_y, av_pts_vie=:av_pts_vie";

	    // prepare query
   		$stmt = $this->conn->prepare($query);

	    // sanitize
	    $this->av_pos_x=htmlspecialchars(strip_tags($this->av_pos_x));
	    $this->av_pos_y=htmlspecialchars(strip_tags($this->av_pos_y));
	    $this->av_pts_vie=htmlspecialchars(strip_tags($this->av_pts_vie));

	    // bind values
	    $stmt->bindParam(":av_pos_x", $this->av_pos_x);
	    $stmt->bindParam(":av_pos_y", $this->av_pos_y);
	    $stmt->bindParam(":av_pts_vie", $this->av_pts_vie);

	    // execute query
	    if($stmt->execute()){
	        return true;
	    }	 
	    return false;	         
	}

	//read aventurier
	function read(){
		$query = "SELECT av_pos_x, av_pos_y, av_pts_vie FROM".$this->table_name."WHERE id_aventurier = ?";

		// prepare query statement
		$stmt = $this->conn->prepare($query);

		// execute query
        $stmt->execute();
     
        return $stmt;
	}

	function update(){
		// update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    
                    av_pos_x = :pos_x,
                    av_pos_y = :pos_y,
                    av_pts_vie = :pts_vie
                WHERE
                    id_aventurier = :id_aventurier";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
	    $this->id_aventurier=htmlspecialchars(strip_tags($this->id_aventurier));
	    $this->pos_x=htmlspecialchars(strip_tags($this->pos_x));
	    $this->pos_y=htmlspecialchars(strip_tags($this->pos_y));
	    $this->pts_vie=htmlspecialchars(strip_tags($this->pts_vie));

	    // bind new values
	    $stmt->bindParam(':id_avanturier', $this->id_avanturier);
        $stmt->bindParam(':pos_x', $this->pos_x);
        $stmt->bindParam(':pos_y', $this->pos_y);
        $stmt->bindParam(':pts_vie', $this->pts_vie);

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
}

?>
<?php
/**
 * 
 */
class obstacle
{
	private $conn;
    private $table_name = "obstacle";

    public $id_obstacle;
    public $pos_x;
    public $pos_y;
	
	function __construct($db)
	{
		$this->conn = $db;
	}

	function create(){
    	// query to insert record
	    $query = "INSERT INTO " . $this->table_name . " 
	    SET obs_pos_x=:pos_x, obs_pos_y=:pos_y";

	    // prepare query
   		$stmt = $this->conn->prepare($query);

	    // sanitize
	    $this->pos_x=htmlspecialchars(strip_tags($this->pos_x));
	    $this->pos_y=htmlspecialchars(strip_tags($this->pos_y));
	    
	    // bind values
	    $stmt->bindParam(":pos_x", $this->pos_x);
	    $stmt->bindParam(":pos_y", $this->pos_y);
	    
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
                    
                    obs_pos_x = :pos_x,
                    obs_pos_y = :pos_y,
                WHERE
                    id_obstacle = :id_obstacle";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
	    $this->id_obstacle=htmlspecialchars(strip_tags($this->id_obstacle));
	    $this->pos_x=htmlspecialchars(strip_tags($this->pos_x));
	    $this->pos_y=htmlspecialchars(strip_tags($this->pos_y));
	    
	    // bind new values
	    $stmt->bindParam(':id_obstacle', $this->id_obstacle);
        $stmt->bindParam(':pos_x', $this->pos_x);
        $stmt->bindParam(':pos_y', $this->pos_y);
        
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
	}

	function read(){
		$query = "SELECT obs_pos_x, obs_pos_y FROM".$this->table_name."WHERE id_obstacle = ?";

		// prepare query statement
		$stmt = $this->conn->prepare($query);

		// execute query
        $stmt->execute();
     
        return $stmt;
	}
}
?>
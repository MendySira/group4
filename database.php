<?php 

/**
 * Base de donne api2
 */
class Database
{
	#les attributs de ma class 
	private $host = "localhost";
	private $db_name = "api_game";
	private $username = "root";
	private $password = "";
	public $conn;
	
	//get the database connection
	public function getConnection()
	{
		$this->conn = null;
		try{
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>
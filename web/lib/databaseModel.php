<?php

/*******************************************
			  Database Model
*******************************************/


class DatabaseModel
{
	// Constants
	private $host = 'localhost';
	private $database = 'db';''
    private $user = 'root';
    private $password = 'root';
    // Members
    private $databaseConnectionInstance = null;
    // States
	private $isConnected = false;
	
	public function connect() {
		try {  
			# MySQL with PDO_MYSQL  
			$databaseConnectionInstance = new PDO("mysql:host=$this->host;dbname=$this->$database", $this->user, $this->pass);  
		}  
		catch(PDOException $e) {  
			echo "Error while connecting to database: " . $e->getMessage();  
		}  
	}
	
	public function isConnected() {
		return $this->isConnected;
	}

}


?>

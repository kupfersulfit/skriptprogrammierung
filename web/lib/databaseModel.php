<?php

/*******************************************
			  Database Model
*******************************************/
class DatabaseConnector {
	// Constants
	private $host = 'localhost';
	private $database = 'db';''
    private $user = 'root';
    private $password = 'root';
    // Members
    private $databaseConnectionInstance = null;
    // States
	private $isConnected = false;
	
	private function connect() {
		try {  
			if ($this->isConnected == false) {				
				# MySQL with PDO_MYSQL  
				$this->databaseConnectionInstance = new PDO("mysql:host=$this->host;dbname=$this->$database", $this->user, $this->pass);
				$this->isConnected = true;
				return true;
			}else{
				return false;
			}
		}  
		catch(PDOException $e) {  
			return false; 
		}  
	}
	
	private function disconnect() {  
		if ($this->isConnected) {	
			# MySQL with PDO_MYSQL  
			$this->databaseConnectionInstance = null;
			$this->isConnected = false;
			return true;
		}else{
			return false
		}
	}
	
	private function isConnected() {
		return $this->isConnected;
	}
	
	private function executeQuery($query) {
		if ($this->isConnected) {
			$queryResult = $this->databaseConnectionInstance->query($query);
			return $queryResult->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return null;
		}
	}
}

class DatabaseModel
{

	public function erstelleArtikel($artikel) {
		$dbConnection = new databaseConnector();
		$dbConnector->connect();
		$quer //TODO prepared statement
		if ($dbConnector->executeQuery($query)) {
			return true;
		}else{
			return false;
		}
		
	}

}


?>

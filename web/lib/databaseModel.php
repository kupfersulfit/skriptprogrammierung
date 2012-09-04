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
		}
	}
	
	private function isConnected() {
		return $this->isConnected;
	}
	
	private function getQueryData($query) {
		if ($this->isConnected) {
			$queryResult = $this->databaseConnectionInstance->query($query);
			return $queryResult->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return null;
		}
	}

}


?>

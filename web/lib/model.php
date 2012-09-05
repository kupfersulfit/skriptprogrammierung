<?php

require "objects.php";

/*******************************************
			  Database Model
*******************************************/
class DatabaseConnector {
	// Constants
	private $host = 'localhost';
	private $database = 'onlineshop';''
    private $user = 'root';
    private $password = 'root';
    // Members
    private $databaseConnectionInstance = null;
	
	public function connect() {
		try {  
			if ($this->isConnected() == false) {				
				# MySQL with PDO_MYSQL  
				$this->databaseConnectionInstance = new PDO("mysql:host=$this->host;dbname=$this->$database", $this->user, $this->pass);
				return true;
			}else{
				return false;
			}
		}  
		catch(PDOException $e) {  
			return false; 
		}  
	}
	
	public function disconnect() {  
		if ($this->isConnected()) {	
			# MySQL with PDO_MYSQL  
			$this->databaseConnectionInstance = null;
			return true;
		}else{
			return false
		}
	}
	
	public function isConnected() {
		return $this->databaseConnectionInstance == null ? false : true;
	}
	
	public function executeQuery($query, $params) {
		if ($this->isConnected()) {
			$this->databaseConnectionInstance->prepare($query);
            $this->databaseConnectionInstance->execute($params);
			return $this->databaseConnectionInstance->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return null;
		}
	}
    
    public function mapObjects($queryResult, $objectName) {
		if ($queryResult != null) {
            $queryResult->setFetchMode(PDO::FETCH_CLASS, $objectName);
        }else{
            return null;
        }
    }
    
}

class DatabaseModel
{
    
$params = array(':username' => 'test', ':email' => $mail, ':last_login' => time() - 3600);
    
$pdo->prepare('
   SELECT * FROM users
   WHERE username = :username
   AND email = :email
   AND last_login > :last_login');
    
$pdo->execute($params);


	public function holeKunde($KundenId) {
		$dbConnection = new databaseConnector();
		if($dbConnector->connect()) {
            $query ="SELECT * FROM kunden WHERE id = :id");
            $params=array(":id" => $KundenId);
            return mapObjects($dbConnector->executeQuery($query, $params), "Kunden");
        }else{
            return null;
        }
	}

}


?>

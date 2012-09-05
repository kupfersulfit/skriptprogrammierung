<?php

// Set to true for testing
$testing = true;

require "objects.php";

/*******************************************
			  Database Model
*******************************************/
class DatabaseConnector {
	// Constants
	private $host = 'localhost';
	private $database = 'onlineshop';
    private $user = 'root';
    private $password = 'root';
    // Members
    private $databaseConnectionInstance = null;
	
	public function connect() {
		try {  
			if ($this->databaseConnectionInstance == null) {				
				# MySQL with PDO_MYSQL  
				$this->databaseConnectionInstance = new PDO("mysql:host=".$this->host.";dbname=".$this->database, $this->user, $this->password);
				return true;
			}else{
				return false;
			}
		}  
		catch(PDOException $e) {  
            echo "Error: " . $e;
			return false; 
		}  
	}
	
	public function disconnect() {  
        if ($this->databaseConnectionInstance != null) {	
            # MySQL with PDO_MYSQL  
            $this->databaseConnectionInstance = null;
			return true;
		}else{
			return false;
		}
	}
	
	public function isConnected() {
		return $this->databaseConnectionInstance == null ? false : true;
	}
	
	public function executeQuery($query, $params) {
		if ($this->databaseConnectionInstance != null) {
			$result = $this->databaseConnectionInstance->prepare($query);
            $result->execute($params);
            return $result;
		}else{
			return null;
		}
	}
    
    public function mapObjects($queryResult, $objectName) {
		if ($queryResult != null) {
            $queryResult->setFetchMode(PDO::FETCH_CLASS, $objectName);
            return $queryResult->fetchAll();
        }else{
            return null;
        }
    }
    
}

class DatabaseModel
{
    public function erstelleKunde($Kunde) {

		$dbConnector = new DatabaseConnector();
		if($dbConnector->connect()) {
            $quyery = "SELECT * FROM kunden WHERE id = :id";
            $params = array(":id" => $KundenId);
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Kunden");
        }else{
            return null;
        }
	}
    
	public function holeKunde($Email) {
		$dbConnector = new DatabaseConnector();
		if($dbConnector->connect()) {
            $query = "SELECT * FROM kunden WHERE email = :email";
            $params = array(":email" => $Email);
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Kunden");
        }else{
            return null;
        }
	}
    
    public function holeAlleKunden() {
		$dbConnector = new DatabaseConnector();
		if($dbConnector->connect()) {
            $query = "SELECT * FROM kunden";
            $params = array();
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Kunden");
        }else{
            return null;
        }
	}
    
    public function holeArtikel($ArtikelId) {
		$dbConnector = new DatabaseConnector();
		if($dbConnector->connect()) {
            $query = "SELECT * FROM artikel WHERE id = :id";
            $params = array(":id" => $ArtikelId);
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Artikel");
        }else{
            return null;
        }
	}
    
    public function holeAlleArtikel() {
		$dbConnector = new DatabaseConnector();
		if($dbConnector->connect()) {
            $query = "SELECT * FROM artikel";
            $params = array();
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Artikel");
        }else{
            return null;
        }
	}

}

/* 
 * Testcase
 */
if ($testing) {
    $testInstance = new DatabaseModel(); 
    echo "<br/>Artikel mit ID 1<br/>";
    $dbo = $testInstance->holeArtikel("1");
    print_r($dbo);
    echo "<br/>Alle Artikel<br/>";
    $dbo = $testInstance->holeAlleArtikel("*");
    print_r($dbo);
    echo "<br/>Kunden mit ID 1<br/>";
    $dbo = $testInstance->holeKunde("josef.ackermann@lionsclub.com");
    print_r($dbo);
    echo "<br/>Alle Kunden<br/>";
    $dbo = $testInstance->holeAlleKunden("*");
    print_r($dbo);
    exit;
}
/* 
 * End Testcase
 */
 

 /*
  * 
/+erstelleArtikel(Artikel artikel) : boolean/
/+holeArtikel(ArtikelId : Integer) : Artikel/
/+holeAlleArtikel() : Artikel[]/
/+sucheArtikel(Pattern : String) : Artikel[]/
/+erstelleKunde(Kunde : Kunde) :boolean/
/+holeKunden(String : email) : Kunde/
/+holeAlleKunden() : Kunde[]/
/+holeBestellungenVonKunden(Kunde : kunde) : Bestellung[]/
/+holeAlleBestellung() : Bestellung[]/
/+holeBestellung() : Bestellung[]/
/+erstelleBestellung(Bestellung : bestellung) :boolean/

* 
*/

?>

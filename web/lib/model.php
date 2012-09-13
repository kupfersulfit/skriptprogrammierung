<?php

// Set to true for testing
$testing = false;

require_once "objects.php";

/**
 * @brief Wrapperklasse für PDO Datenbankverbindung
 */
class DatabaseConnector {

    // Constants
    private $host = 'localhost';
    private $database = 'onlineshop';
    private $user = 'root';
    private $password = 'root';
    // Members
    public $lastInsertId = null;
    private $databaseConnectionInstance = null;

	/**
     * @brief Connects to database with hardcoded login data
     * 
     * @retval boolean
     *  True in success
     */
    public function connect() {
        try {
            if ($this->databaseConnectionInstance == null) {
                # MySQL with PDO_MYSQL  
                $this->databaseConnectionInstance = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->user, $this->password);
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e;
            return false;
        }
    }

	/**
	 * @brief Terminates an existing connection to a database
	 * 
     * @retval boolean
     *  True in success
	 */
    public function disconnect() {
        if ($this->databaseConnectionInstance != null) {
            # MySQL with PDO_MYSQL  
            $this->databaseConnectionInstance = null;
            return true;
        } else {
            return false;
        }
    }
     
     /**
	 * @brief Shows connection status
	 * 
     * @retval boolean
     *  True on existing connection to database
	 */
    public function isConnected() {
        return $this->databaseConnectionInstance == null ? false : true;
    }

	/**
     * @brief Searches in database
     * 
     * @param String $query
     *  SQL statement containing $preparedFieldname e.g. :pattern
     * @param String $preparedFieldname
     *  Name of the pattern to be replaced for executing prepared sql statement 
     * @param String $searchValue
     *  Value to search for in database
     * @retval PDOStatement
     *  Executed pdo statement object
     */
	public function doSearch($query, $preparedFieldname, $searchValue) {
        if ($this->databaseConnectionInstance != null) {
            $result = $this->databaseConnectionInstance->prepare($query);
            $result->bindValue($preparedFieldname, $searchValue, PDO::PARAM_STR);
            $result->execute();
            return $result;
        } else {
            return null;
        }
    }
    
    /**
     * @brief Executes a Query in a database
     * 
     * @param String $query
     *  SQL statement containing $preparedFieldname e.g. :pattern
     * @param string[][] $params
     *  Associative string array with :pattern => value to process the prepared statement
     * @retval PDOStatement
     *  Executed pdo statement object
     */
    public function executeQuery($query, $params) {
        if ($this->databaseConnectionInstance != null) {
            $this->lastInsertId = null;
            $result = $this->databaseConnectionInstance->prepare($query);
            $result->execute($params);
            $this->lastInsertId = $this->databaseConnectionInstance->lastInsertId(); 
            return $result;
        } else {
            return null;
        }
    }

	/**
     * @brief Maps a result of a PDOStatement object to an Array of type $objectName
     * 
     * @param String $queryResult
     *  Executed pdo statement object
     * @param string $objectName
     *  Name of object to map database query result to
     * @retval Object[]
     *  Array of objects from type $objectName
     */
    public function mapObjects($queryResult, $objectName) {
        if ($queryResult != null) {
            $queryResult->setFetchMode(PDO::FETCH_CLASS, $objectName);
            return $queryResult->fetchAll();
        } else {
            return null;
        }
    }

}

/**
 * 
 * @brief Modell für Datenhaltung / -beschaffung und Objektmapping
 * 
 */
class DatabaseModel {

    /**
     * @brief Erstellt einen neuen Kunden in der Datenbank auf Grundlage des übergebenen Kundenobjekts.
     * 
     * @param String $kunde
     *  Objekt des anzulegenden Kunden
     * @retval boolean
     *  True on success.
     */
    public function erstelleKunde($kunde) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
        	print_r($kunde);
            $query = "INSERT INTO kunden VALUES('', :name, :vorname, :strasse, :plz, :zusatz, :email, :passwort, :registriertseit)";
            $params = array(
            ":name" => $kunde->getName(),
            ":vorname" => $kunde->getVorname(),
            ":strasse" => $kunde->getStrasse(),
            ":plz" => $kunde->getPlz(),
            ":zusatz" => $kunde->getZusatz(),
            ":email" => $kunde->getEmail(),
            ":passwort" => $kunde->getPasswort(), 
            ":registriertseit" => $kunde->getRegistriertseit()
            );
            $dbConnector->executeQuery($query, $params);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @brief Holt Kunde mit gegebener ID
     * 
     * @param String $kundenId
     *  ID des gewünschten Kundens
     * @retval Kunde
     *  Objekt des gewünschten Kunden 
     */
    public function holeKundeMitId($kundenId) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM kunden WHERE id = :id";
            $params = array(":id" => $kundenId);
            $result = $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Kunde");
            if (sizeof($result) == 1) {
				return $result[0];
			}
        } else {
            return null;
        }
    }

	/**
     * @brief Aktualisiert Kunde mit gegebener EMail
     * 
     * @param String $email
     *  Email des gewünschten Kundens
     */
    public function aktualisiereKunde($aktuellerKunde) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "UPDATE kunden SET 
            name = :name,
            vorname = :vorname,
            strasse = :strasse,
            plz = :plz,
            zusatz = :zusatz,
            passwort = :passwort
            WHERE email = :email";   
            $params = array(
            ":name" => $aktuellerKunde->getName(),
            ":vorname" => $aktuellerKunde->getVorname(),
            ":strasse" => $aktuellerKunde->getStrasse(),
            ":plz" => $aktuellerKunde->getPlz(),
            ":zusatz" => $aktuellerKunde->getZusatz(),
            ":email" => $aktuellerKunde->getEmail(),
            ":passwort" => $aktuellerKunde->getPasswort()
            );        
            $dbConnector->executeQuery($query, $params);
        }
    }

    /**
     * @brief Holt Kunde mit gegebener EMail
     * 
     * @param String $email
     *  Email des gewünschten Kundens
     * @retval Kunde
     *  Objekt des gewünschten Kunden 
     */
    public function holeKunde($email) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM kunden WHERE email = :email";
            $params = array(":email" => $email);
            $result = $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Kunde");
            if (sizeof($result) == 1) {
				return $result[0];
			}else if (sizeof($result) > 1) {
				// Should never happen 11!1!
				throw new Exception("Email {$email} not unique.");
			}else {
				return null;
			}
        } else {
            return null;
        }
    }

    /**
     * @brief Loescht Kunde mit gegebener EMail
     * 
     * @param String $email
     *  Email des zu loeschenden Kundens
     */
    public function loescheKunde($email) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "DELETE FROM kunden WHERE email = :email";
            $params = array(":email" => $email);
            $result = $dbConnector->executeQuery($query, $params);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @brief Holt alle Kunden.
     * 
     * @retval Kunden[]
     *  Objektarray der Kunden.
     */
    public function holeAlleKunden() {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM kunden";
            $params = array();
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Kunde");
        } else {
            return null;
        }
    }

    /**
     * @brief Erstellt einen neuen Artikel in der Datenbank auf Grundlage des übergebenen Artikeobjekts.
     * 
     * @param String $artikel
     *  Objekt des anzulegenden Artikels
     * @retval boolean
     *  True on success.
     */
    public function erstelleArtikel($artikel) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "INSERT INTO artikel VALUES( null, :name, :beschreibung, :veroeffentlicht, :verfuegbar, :katgorieid, :preis, :bildpfad, :seit)";
            $params = array(
            ":name" => $artikel->getName(),
            ":beschreibung" => $artikel->getBeschreibung(),
            ":veroeffentlicht" => $artikel->getVeroeffentlicht(),
            ":verfuegbar" => $artikel->getVerfuegbar(),
            ":katgorieid" => $artikel->getPreis(),
            ":preis" => $artikel->getKategorieId(),
            ":bildpfad" => $artikel->getBildpfad(),
            ":seit" => $artikel->getSeit()
            );          
            $dbConnector->executeQuery($query, $params);
            return true;
        } else {
            return false;
        }
    }

	/**
     * @brief Aktualisiert Artikel mit gegebener ID
     * 
     * @param String $email
     *  Email des gewünschten Kundens
     */
    public function aktualisiereArtikel($aktuellerArtikel) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "UPDATE artikel SET 
            name = :name,
            beschreibung = :beschreibung,
            veroeffentlicht = :veroeffentlicht,
            verfuegbar = :verfuegbar,
            kategorieid = :kategorieid,
            preis = :preis,
            bildpfad = :bildpfad,
            seit = :seit
            WHERE id = :id";   
            $params = array(
            ":id" => $aktuellerArtikel->getId(),
            ":name" => $aktuellerArtikel->getName(),
            ":beschreibung" => $aktuellerArtikel->getBeschreibung(),
            ":veroeffentlicht" => $aktuellerArtikel->getVeroeffentlicht(),
            ":verfuegbar" => $aktuellerArtikel->getVerfuegbar(),
            ":kategorieid" => $aktuellerArtikel->getKategorieId(),
            ":preis" => $aktuellerArtikel->getPreis(),
            ":bildpfad" => $aktuellerArtikel->getBildpfad(),
            ":seit" => $aktuellerArtikel->getSeit()
            );        
            $dbConnector->executeQuery($query, $params);
        }
    }

    /**
     * @brief Loescht Artikel mit gegebener ID
     * 
     * @param String $artikelId
     *  ID des zu löschenden Artikels
     */
    public function loescheArtikel($artikelId) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "DELETE FROM artikel WHERE id = :id";
            $params = array(":id" => $artikelId);
            $dbConnector->executeQuery($query, $params);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @brief Holt Artikel mit gegebener ID
     * 
     * @param String $artikelId
     *  ID des gewünschten Artikels
     * @retval Artikel
     *  Objekt des gewünschten Artikels 
     */
    public function holeArtikel($artikelId) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM artikel WHERE id = :id";
            $params = array(":id" => $artikelId);
            $result = $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Artikel");
            if (sizeof($result) == 1) {
				return $result[0];
			}
        } else {
            return null;
        }
    }
    
    /**
     * @brief Holt alle Artikeln.
     * 
     * @retval Artikel[]
     *  Objektarray der Artikel.
     */
    public function holeAlleArtikel() {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM artikel";
            $params = array();
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Artikel");
        } else {
            return null;
        }
    }
    
    /**
     * @brief Holt alle  Artikeln, welche als veröffentlicht gespeichert wurden
     * 
     * @retval Artikel[]
     *  Objektarray der veröffentlichten Artikel
     */
    public function holeAlleVeroeffentlichtenArtikel() {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM artikel WHERE veroeffentlicht = 1";
            $params = array();
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Artikel");
        } else {
            return null;
        }
    }
    
    /**
     * @brief Sucht nach Artikeln mit gegebenen Pattern
     * 
     * @param String $pattern
     *  Pattern enthalten in Name / Beschreibung der gesuchten Artikel
     * @retval Artikel[]
     *  Objektarray der gesuchten Artikel
     */
    public function sucheArtikel($pattern) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM artikel WHERE name LIKE :pattern OR beschreibung LIKE :pattern";
            return $dbConnector->mapObjects($dbConnector->doSearch($query, ":pattern" ,"%".$pattern."%"), "Artikel");
        } else {
            return null;
        }
    }

    /**
     * @brief Holt Kategorie mit gegebener ID
     * 
     * @param String $kategorieId
     *  ID der gewünschten Kategorie
     * @retval Kategorie
     *  Objekt der gewünschten Kategorie 
     */
    public function holeKategorie($kategorieId) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM kategorien WHERE id = :id";
            $params = array(":id" => $kategorieId);
            $result = $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Kategorie");
            if (sizeof($result) == 1) {
				return $result[0];
			}
        } else {
            return null;
        }
    }

    /**
     * @brief Holt eine Lieferungsmethode mit gegebener Suchpattern
     * 
     * @param String $lieferungsmethodenPattern
     *  Pattern enthalten in Name / Beschreibung der gesuchten Lieferungsmethode
     * @retval Lieferungsmethode
     *  Objekt der gesuchten Lieferungsmethode
     */
    public function holeLieferungsmethode($lieferungsmethodenPattern) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM lieferungsmethoden WHERE name LIKE ':lieferungsmethodenPattern' OR  beschreibung LIKE ':lieferungsmethodenPattern'";
            $params = array(":lieferungsmethodenPattern" => $lieferungsmethodenPattern);
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Lieferungsmethode");
        } else {
            return null;
        }
    }
    
    
    /**
     * @brief Holt eine Zahlungsmethode mit gegebener Suchpattern
     * 
     * @param String $zahlungsmethodePattern
     *  Pattern enthalten in Name / Beschreibung der gesuchten Zahlungsmethode
     * @retval Zahlungsmethode
     *  Objekt der gesuchten Zahlungsmethode
     */
    public function holeZahlungsmethode($zahlungsmethodePattern) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM zahlungsmethoden WHERE name LIKE ':zahlungsmethodePattern' OR  beschreibung LIKE ':zahlungsmethodePattern'";
            $params = array(":zahlungsmethodePattern" => $zahlungsmethodePattern);
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Lieferungsmethode");
        } else {
            return null;
        }
    }
    
    
    /**
     * @brief Holt einen Status mit gegebener Suchpattern
     * 
     * @param String $statusPattern
     *  Pattern enthalten in Name / Beschreibung des gesuchten Status
     * @retval Lieferungsmethode
     *  Objekt des gesuchten Status
     */
    public function holeStatus($statusPattern) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM status WHERE name LIKE ':statusPattern' OR  beschreibung LIKE ':statusPattern'";
            $params = array(":statusPattern" => $statusPattern);
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Status");
        } else {
            return null;
        }
    }

	/**
     * @brief Gibt alle Artikel einer Bestellung zurueck
     * 
     * @param Integer $bestellungId
     *  ID der Bestellung, deren Artikel geholt werden sollen
     * @retval Artikel[]
     *  Objektarray der geholten Artikel.
     */
    public function holeArtikelVonBestellung($bestellung) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM bestellungen_artikel LEFT JOIN artikel ON artikel.id = bestellungen_artikel.artikelid
WHERE bestellungen_artikel.bestellungid = :bestellungid";
            $params = array(":bestellungid" => $bestellung->getId());
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Artikel");
        } else {
            return null;
        }
    }

    /**
     * @brief Gibt alle Bestellungen von Kunden mit übergebener ID zurück
     * 
     * @param Integer $kundenId
     *  ID des Kunden, dessen Bestellungen geholt werden sollen
     * @retval Bestellungen[]
     *  Objektarray der geholten Bestellungen.
     */
    public function holeBestellungenVonKunden($kundenId) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM bestellungen WHERE kundenid = :kundenid";
            $params = array(":kundenid" => $kundenId);
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Bestellung");
        } else {
            return null;
        }
    }

    /**
     * @brief Gibt alle vorhanden Bestellungen zurück
     * 
     * @retval Bestellungen[]]
     *  Objektarray vom Typ Bestellung.
     */
    public function holeAlleBestellungen() {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM bestellungen";
            $params = array();
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Bestellung");
        } else {
            return null;
        }
    }
    
    /**
     * @brief Erstellt eine Bestellung auf Grundlage der Paramter, welche aus mehreren Artikelnzuordnungen bestehen kann.
     * 
     * @param Bestellung $bestellung
     *  Objekt des Typs Bestellung, welches alle Daten der anzulegenden Bestellung enthält.
     * @param Artikel[] $alleArtikel
     *  Objektarray des Typs Artikel, welches alle Artikel der anzulegenden Bestellung enthält.
     * @retval boolean
     *  True on success.
     */
    public function erstelleBestellung($bestellung, $alleArtikel) {
        // 
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "INSERT INTO bestellungen VALUES(null, :kundenid, :bestelldatum, :statusid, :zahlungsmethodeid, :lieferungsmethodeid)";
            $params = array(
            ":kundenid" => $bestellung->getKundenId(),
            ":bestelldatum" => $bestellung->getBestelldatum(),
            ":statusid" => $bestellung->getStatusId(),
            ":zahlungsmethodeid" => $bestellung->getZahlunsgmethodeId(),
            ":lieferungsmethodeid" => $bestellung->getLieferunsgmethodeId()
            );
            $dbConnector->executeQuery($query, $params);
            // Create articles
            $lastOrderId = $dbConnector->lastInsertId;
            foreach ($alleArtikel as $artikel)
            {
                    $query = "INSERT INTO bestellungen_artikel VALUES( :bestellungid, :artikelid, :anzahl)";
                    $params = array(
                        ":bestellungid" => $lastOrderId,
                        ":artikelid" => $artikel->getId(),
                        ":anzahl" => $artikel->getVerfuegbar()
                    );
                    $dbConnector->executeQuery($query, $params);
            }
         	return true;
        } else {
            return false;
        }
    }

    /**
     * @brief Prüft auf gültige Logindaten
     * 
     * @param string $email
     *  Emailadresse
     * * @param string $passwortHash
     *  Hash des Passworts
     * @retval boolean
     *  True on success.
     */
    public function pruefeLogin($email, $passwortHash) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM kunden WHERE passwort = :passwort AND email = :email";
            $params = array(":passwort" => $passwortHash, ":email" => $email);
            $result = $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Bestellung");
            if (sizeof($result) == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

/*
 * Testcase
 */
if ($testing) {
    $testInstance = new DatabaseModel();
    echo "<br/>***Artikel mit ID 1<br/><div style='border: 1px red solid;'>";
    $dbo = $testInstance->holeArtikel(1);
    print_r($dbo);
    echo "</div><br/>***Alle Artikel<br/><div style='border: 1px green solid;'>";
    $dbo = $testInstance->holeAlleArtikel();
    print_r($dbo);
    echo "</div><br/>Kunden mit emailadresse<br/><div style='border: 1px blue solid;'>";
    $dbo = $testInstance->holeKunde("josef.ackermann@lionsclub.com");
    print_r($dbo);
    echo "</div><br/>***Alle Kunden<br/><div style='border: 1px black solid;'>";
    $dbo = $testInstance->holeAlleKunden();
    print_r($dbo);
    echo "</div><br/>***Gesuchte Artikel fuer Butler<br/><div style='border: 1px yellow solid;'>";
    $dbo = $testInstance->sucheArtikel("Butler");
    print_r($dbo);
    echo "</div><br/>***Erstelle Artikel 'Testartikel'<br/><div style='border: 1px grey solid;'>";
    
    $artikel = new Artikel(
		array(
			"id" => "", 
			"name" => "Testartikel", 
			"beschreibung" => "Dies ist ein Testartikel", 
			"veroeffentlicht" => "1",
			"verfuegbar" => "1",
			"kategorieid" => "1",
			"preis" => "299",
			"bildpfad" => "foobar",
			"seit" => "2012-09-02 09:50:41"
		)
    );
    $dbo = $testInstance->erstelleArtikel($artikel);
    $dbo = $testInstance->sucheArtikel("Testartikel");
	$theID = $dbo[0]->getId();
    print_r($dbo);
    echo "<br/>***Loesche Artikel, wenn er jetzt nicht mehr erscheint ->Erfolg<br/>";
    $dbo = $testInstance->loescheArtikel($theID);
    $dbo = $testInstance->sucheArtikel("Testartikel");
    print_r($dbo);
    echo "</div>";
    echo "</div>";
    
    echo "</div><br/>***Erstelle Kunden 'Testkunde'<br/><div style='border: 1px pink solid;'>";

    $kunde = new Kunde(
    array( 
    "id" => "", 
    "name" => "Brot", 
    "vorname" => "Bernd", 
    "strasse" => "Am Illuminaten 3",
    "plz" => "23423",
    "zusatz" => "",
    "email" => "ernte23@peanuts.de",
    "passwort" => "fooobar",
    "registriertseit" => "2012-09-04 09:42:47"));
    $dbo = $testInstance->erstelleKunde($kunde);
    $dbo = $testInstance->holeKunde("ernte23@peanuts.de");
    print_r($dbo);
    echo "<br/>***Loesche kunde, wenn er jetzt nicht mehr erscheint ->Erfolg<br/>";
    $dbo = $testInstance->loescheKunde("ernte23@peanuts.de");
    $dbo = $testInstance->holeKunde("ernte23@peanuts.de");
    print_r($dbo);
    echo "</div>";
    
    echo "</div><br/>***Teste das Holen von Artikeln der Bestellung mit ID 1<br/><div style='border: 1px brown solid;'>";
	
	$bestellung = new Bestellung(
		array(
			"id" => 1
		)
	);
    $dbo = $testInstance->holeArtikelVonBestellung($bestellung);
    print_r($dbo);
    echo "</div>";
    exit;
}
/*
 * End Testcase
 */

?>

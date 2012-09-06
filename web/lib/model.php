<?php

// Set to true for testing
$testing = false;

require_once "objects.php";

/**
 * 
 * @brief Wrapperklasse für PDO Datenbankverbindung
 * 
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

    public function disconnect() {
        if ($this->databaseConnectionInstance != null) {
            # MySQL with PDO_MYSQL  
            $this->databaseConnectionInstance = null;
            return true;
        } else {
            return false;
        }
    }

    public function isConnected() {
        return $this->databaseConnectionInstance == null ? false : true;
    }

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

    public function erstelleKunde($kunde) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "INSERT INTO kunden VALUES('', ':name', ':vorname', ':strasse', ':plz', ':zusatz', ':email', ':passwort', ':registriertseit')";
            $params = array(
            ":name" => $kunde->name,
            ":vorname" => $kunde->vorname,
            ":strasse" => $kunde->strasse,
            ":plz" => $kunde->plz,
            ":zusatz" => $kunde->zusatz,
            ":email" => $kunde->email,
            ":passwort" => $kunde->passwort, 
            ":registriertseit" => $kunde->registriertseit
            );
            $dbConnector->executeQuery($query, $params);
            return true;
        } else {
            return false;
        }
    }

    public function holeKunde($email) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM kunden WHERE email = :email";
            $params = array(":email" => $email);
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Kunden");
        } else {
            return null;
        }
    }

    public function holeAlleKunden() {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM kunden";
            $params = array();
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Kunden");
        } else {
            return null;
        }
    }

    public function erstelleArtikel($Artikel) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "INSERT INTO artikel VALUES('', ':name', ':vorname', ':strasse', ':plz', ':zusatz', ':email', ':passwort', ':registriertseit'";
            $params = array(
            ":name" => $kunde->name,
            ":vorname" => $kunde->vorname,
            ":strasse" => $kunde->strasse,
            ":plz" => $kunde->plz,
            ":zusatz" => $kunde->zusatz,
            ":email" => $kunde->email,
            ":passwort" => $kunde->passwort,
            ":registriertseit" => $kunde->registriertseit
            );
            $dbConnector->executeQuery($query, $params);
            return true;
        } else {
            return false;
        }
    }

    public function holeArtikel($artikelId) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM artikel WHERE id = :id";
            $params = array(":id" => $artikelId);
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Artikel");
        } else {
            return null;
        }
    }

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
    
    public function holeAlleVeroeffentlichtenArtikel() {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM artikel WHERE veroeffentlicht=1";
            $params = array();
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Artikel");
        } else {
            return null;
        }
    }
    
    public function sucheArtikel($pattern) {
        $dbConnector = new DatabaseConnector();
        if ($dbConnector->connect()) {
            $query = "SELECT * FROM artikel WHERE name LIKE '%:pattern%' OR beschreibung='%:pattern%";
            $params = array(":pattern" => $pattern);
            return $dbConnector->mapObjects($dbConnector->executeQuery($query, $params), "Artikel");
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
            $query = "SELECT * FROM bestellung WHERE kundenid = :kundenid";
            $params = array(":kundenid" => $KundenId);
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
            $query = "SELECT * FROM bestellung";
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
            $query = "INSERT INTO bestellung VALUES('', ':kundenid', ':bestelldatum', ':statusid', ':zahlungsmethodeid', ':lieferungsmethodeid')";
            $params = array(
            ":kundenid" => $bestellung->kundenid,
            ":bestelldatum" => $bestellung->bestelldatum,
            ":statusid" => $bestellung->statusid,
            ":zahlungsmethodeid" => $bestellung->zahlungsmethodeid,
            ":lieferungsmethodeid" => $bestellung->lieferungsmethodeid
            );
            $dbConnector->executeQuery($query, $params);
            // Create articles
            $lastOrderId = $dbConnector->lastInsertId;
            foreach ($alleArtikel as $artikel)
            {
                if ($dbConnector->connect()) {
                    $query = "INSERT INTO bestellungen_artikel VALUES( ':bestellungid', ':artikelid', ':anzahl' )";
                    $params = array(
                        ":bestellungid" => $lastOrderId,
                        ":artikelid" => $artikel->bestelldatum,
                        ":anzahl" => $artikel->statusid
                    );
                    $dbConnector->executeQuery($query, $params);
                }
                return true;
            }
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
    echo "<br/>Artikel mit ID 1<br/>";
    $dbo = $testInstance->holeArtikel("1");
    print_r($dbo);
    echo "<br/>Alle Artikel<br/>";
    $dbo = $testInstance->holeAlleArtikel();
    print_r($dbo);
    echo "<br/>Kunden mit emailadresse<br/>";
    $dbo = $testInstance->holeKunde("josef.ackermann@lionsclub.com");
    print_r($dbo);
    echo "<br/>Alle Kunden<br/>";
    $dbo = $testInstance->holeAlleKunden();
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klassen - Beispiel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php
// Schnittstelle Gewährleistet die Kommunikation zwischen Klassen //
interface Wachstum {
    // Zu implementierende Methode //
    function altern();
}

// Abstraktion einer Klasse //
abstract class Lebewesen implements Wachstum {
    // Eigenschaften schützen, sodass über ein Objekt kein direkter Zugriff möglich ist! //
    protected $alter = 35;
    protected $geschlecht;

    public function altern() {}
    public final function getAlter() {
        return $this->alter;
    }
}

// Klasse Mensch wird durch die Superklasse Lebewesen erweitert (Vererbung) //
class Mensch extends Lebewesen {
    protected static $vorfahre = "Affen";
    protected $name;

    // Konstruktor //
    public function __construct($name, $geschlecht) {
        $this->name = $name;
        $this->geschlecht = $geschlecht;
        $this->altern();
    }

    // Destruktor //
    public function __destruct() {
        echo "<p style='color: darkviolet;'>... und so scheidet ".$this->name." dahin.</p>";
    }

    // Finale Methoden //
    public final function altern() {
        $this->alter++;
    }

    public final function getName() {
        return $this->name;
    }

    public function umbenennen($neuerName) {
        $this->name = $neuerName;
    }

    public function geburtstagFeiern() {
        $this->altern();
        echo "tröööt";
    }

    // Statische Methoden //
    public static final function neueEvolutionstheorie($neuerVorfahre) {
        Mensch::$vorfahre = $neuerVorfahre;
    }

    public static final function getVorfahre() {
        return Mensch::$vorfahre;
    }
}

// Klasse Deutscher erbt von Mensch //
class Deutscher extends Mensch {
    public function __construct($name, $geschlecht) {
        parent::__construct($name, $geschlecht);
    }

    public function umbenennen($neuerName, $geduldsfaden = false) {
        $erfolg = $this->behoerdengang($geduldsfaden);
        if ($erfolg) $this->name = $neuerName;
    }

    // Private Methode //
    private function behoerdengang($geduldsfaden) {
        try {
            if (!$geduldsfaden)
                throw new Exception("Umbennenung fehlgeschlagen");
                return true;
        } catch (Exception $prop) {
            echo $prop->getMessage()."<br>";
            return false;
        }
    }
}


// Autor erzeugen (Objekt) //
$autor = new Mensch("Mario", "m");

// Auf die Methode getName() zugreifen //
echo "<b style='color: red;'>".$autor->getName()."</b><br>";

// Autor umbenennen //
$autor->umbenennen("Marihuana");

// Folgende Codezeile erzeugt einen Fehler da die Eigenschaft geschützt ist! //
// echo $autor->geschlecht;

// An das Alter gelangt man mit Hilfe der Funktion getAlter() //
echo "<p style='color: dodgerblue;'>Alter des Autors: ".$autor->getAlter()."</p>";

// Stammt Autor vom Mensch ab? //
if ($autor instanceof Mensch) {
    echo $autor->getName()." ist ein Mensch! <br>";
}

// Wer sind die Vorfahren der Menschen. //
echo "Der Mensch stammt vom ".Mensch::getVorfahre()." ab. ";

// Neue Theorie // 
Mensch::neueEvolutionstheorie("Homosapien");

// Wer sind nun die Vorfahren der Menschen //
echo "Der Mensch ist eine Genmanipulation aus Affe und ".Mensch::getVorfahre().".<br>";

// Autorin erzeugen (Objekt)
$autorin = new Deutscher("Simone", "w");

// Die Methode behoerdengang ist über das Objekt nicht zu erreichen, da diese als private gekennzeichnet ist! //
// $autorin->behoerdengang(true);

// Gibt den Ausnahmefall aus, da das zweite Argument false ist in (throw/catch). //
$autorin->umbenennen("Monemaus", true);

// Close //
?>
</body>
</html>
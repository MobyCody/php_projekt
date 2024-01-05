<?php

// Stand 231212_EH
// Dieser Code ist geschrieben aber noch nicht getestet !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

$DBproductName = $_POST['phpProductName'];
$DBbrandName = $_POST['phpBrandName'];
$DBwhoPayed = $_POST['phpWhoPayed'];
$DBprice = $_POST['phpPrice'];
$DBdate = $_POST['phpDate'];
$DBid = $_POST['phpID'];

// / Hilfszeile um zu schauen, ob die Übergabe funktioniert.
 echo $_POST["phpProductName"] . " " . $_POST["phpBrandName"]  . " " . $_POST["phpWhoPayed"]  . " " . $_POST["phpPrice"] . " " . $_POST["phpDate"] . "\n";

// Aufruf der Funktion mysqli mit den Übergabeparametern
// Link zur DB, User, Passwort, Name der DB
$mysqliVariable = new mysqli("localhost", "root", "", "db_firmentechnik");

// Hier greift der Pfeil-Operator -> auf die Eigenschaft host_info der Objektinstanz $mysqliVariable zu. 
// In der Kontextzeile echo $mysqliVariable->host_info . "\n"; bezieht sich host_info auf eine Eigenschaft 
// der MySQLi-Klasse in PHP, die Informationen über die MySQL-Datenbankverbindung liefert, insbesondere über den Host (Datenbankserver).
echo $mysqliVariable->host_info . "\n";

$mysqliVariable->query("UPDATE tbl_firmentechnik SET ProdName='$DBproductName', Marke='$DBbrandName', Kostenstelle='$DBwhoPayed', Preis='$DBprice', Kaufdatum='$DBdate' WHERE ID='$DBid'");

if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];
    header("Location: $referer");
} else {
    // If no referring page is found, redirect to a default page
    header("Location: /bearbeiten.html");
}
exit();


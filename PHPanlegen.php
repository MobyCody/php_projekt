<?php

// Stand 231212_EH

$DBproductName = $_POST['phpProductName'];
$DBbrandName = $_POST['phpBrandName'];
$DBwhoPayed = $_POST['phpWhoPayed'];
$DBprice = $_POST['phpPrice'];
$DBdate = $_POST['phpDate'];

// / Hilfszeile um zu schauen, ob die Übergabe funktioniert.
 echo $_POST["phpProductName"] . " " . $_POST["phpBrandName"]  . " " . $_POST["phpWhoPayed"]  . " " . $_POST["phpPrice"] . " " . $_POST["phpDate"] . "\n";


// Aufruf der Funktion mysqli mit den Übergabeparametern
// Link zur DB, User, Passwort, Name der DB
$mysqliVariable = new mysqli("localhost", "root", "", "db_firmentechnik");


// Hier greift der Pfeil-Operator -> auf die Eigenschaft host_info der Objektinstanz $mysqliVariable zu. 
// In der Kontextzeile echo $mysqliVariable->host_info . "\n"; bezieht sich host_info auf eine Eigenschaft 
// der MySQLi-Klasse in PHP, die Informationen über die MySQL-Datenbankverbindung liefert, insbesondere über den Host (Datenbankserver).
echo $mysqliVariable->host_info . "\n";

// $mysqliVariable: Das ist das MySQLi-Objekt, das die Verbindung zur Datenbank repräsentiert.
// ->: Der Pfeil-Operator wird verwendet, um auf Eigenschaften und Methoden eines Objekts zuzugreifen.
// query(...): Die Methode query wird aufgerufen, um eine SQL-Abfrage an die Datenbank zu senden.
// INSERT INTO tbl_firmentechnik () >> schreibt in die tbl_firmentechnik 
//                                  >> in Klammern die Namen und Reihenfolge der Spalten in der die VALUES gleich kommen
//                                      >> das ist nötig, weil wir eine erste Zeile als ID mit Auto_Increment angelegt haben, die vom Nutzer nicht befüllt wird, un das
//                                         Programm sonst zurückgibt, dass die Anzahl Spalten der DB nicht mit der Anzahl der eingegebenen Werte Übereinstimmt
// VALUES () >> greift dann auf die oben angelegten Variablen zu und befüllt die DB
$mysqliVariable->query("INSERT INTO tbl_firmentechnik (ProdName, Marke, Kostenstelle, Preis, Kaufdatum) VALUES ('$DBproductName', '$DBbrandName', '$DBwhoPayed', '$DBprice', '$DBdate')");





// was hier folgt sind Notizen von Elske, die für den Code nicht wichtig sind aber in der Entwicklung nötig waren, und ggf noch mal gebraucht werden ////////////////////////////////////////////
/*
$mysqliVariable->query("INSERT INTO tbl_firmentechnik VALUES ($_POST['phpProductName'], $_POST['phpBrandName'], $_POST['phpWhoPayed'], $_POST['phpPrice'], $_POST['phpDate']) ");


$productName = mysqli_real_escape_string($mysqli, $_POST['phpProductName']);
$brandName = mysqli_real_escape_string($mysqli, $_POST['phpBrandName']);
$whoPayed = mysqli_real_escape_string($mysqli, $_POST['phpWhoPayed']);
$price = mysqli_real_escape_string($mysqli, $_POST['phpPrice']);
$date = mysqli_real_escape_string($mysqli, $_POST['phpDate']);

$query = "INSERT INTO tbl_firmentechnik VALUES ('$productName', '$brandName', '$whoPayed', '$price', '$date')";
$mysqli->query($query);

*/

if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];
    header("Location: $referer");
} else {
    // If no referring page is found, redirect to a default page
    header("Location: /bearbeiten.html");
}
exit();

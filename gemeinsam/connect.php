<?php

// Korrektes abspeichern des User-Inputs aus der index.html
// Mit $variablenname koennen wir Variablen erstellen.
// Die Funktion filter_input() liefert die Eingabe aus der HTML-Datei,
// welche mit der methode "POST" gesendet wurde.
$vorname = filter_input(INPUT_POST, 'vorname');
$nachname = filter_input(INPUT_POST, 'nachname');
$beruf = filter_input(INPUT_POST, 'beruf');
$gehalt = filter_input(INPUT_POST, 'gehalt');
$zufriedenheit = filter_input(INPUT_POST, 'zufriedenheit');

// Wir erstellen ein IF-Statement, um zu ueberpruefen ob der Vorname angegeben
// wurde.
if (!empty($vorname)){

  // Wir erstellen Variablen fuer alle Parameter, die zum Zugriff
  // auf unsere Datenbank benoetigt werden.

  $host = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "arbeitsdaten";

  // Wir bauen eine Verbindung zu unserer Datenbank auf
  $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

  // Falls die Verbindung fehlschlaegt, soll uns eine Fehlermeldung
  // ausgegeben werden
  if(mysqli_connect_error()){
    die('Verbindungsfehler (' . mysqli_connect_errno() . ')'
    . mysqli_connect_error());
  }

  // Falls die Verbindung nicht fehlschlaegt, uebermitteln wir unsere Daten
  // an die Datenbank
  else{
    // Der SQL-Befehl fuer die Datenuebermittlung wird als Variable abgespeichert
    $sql = "INSERT INTO
    personen (vorname, nachname, beruf, gehalt, zufriedenheit)
    values ('$vorname', '$nachname', '$beruf', '$gehalt', '$zufriedenheit')";

    // Falls die Daten korrekt uebermittelt wurden, erhalten wir eine Erfolgs-
    // meldung
    if ($conn->query($sql)){
      echo "Eintrag erfolgreich gespeichert. <br>";
      echo "<a href='index.html'>Neuen Eintrag eingeben.</a>";
    }

    // Falls die Datenuebermittlung fehlschlaegt erhalten wir eine Fehlermeldung
    else{
      echo "Fehler: " . $sql . "<br>" . $conn->error;
    }

    // Die Verbindung muss am Ende wieder geschlossen werden.
    $conn->close();
  }


}

// Wurde der Vorname nicht angegeben, so geben wir eine Fehlermeldung aus
// und beenden den Vorgang mit die();
else {
  echo "Bitte geben Sie einen Vornamen ein!";
  die();
}

?>

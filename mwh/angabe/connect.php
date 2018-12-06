<?php
  vorname = filter_input(INPUT_POST, 'vorname');
  nachname = filter_input(INPUT_POST, 'nachname');
  wohnort = filter_input(INPUT_POST, 'wohnort');
  flaeche = filter_input(INPUT_POST, 'flaeche');
  zimmer = filter_input(INPUT_POST, 'zimmer');

  // Daten fuer unsere Verbindung
  $host = "index.html";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "wohndaten";

  // Wir bauen eine Verbindung zu unserer Datenbank auf
  $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

  // Datenuebermittlung mittels SQL
  $sql = "INSERT INTO
  haeuser (vorname, nachname, wohnort, flaeche, zimmer)
  values ('$vorname', '$nachname', '$wohnort', '$flaeche', '$zimmer')";

  $conn->query($sql);

  // Die Verbindung muss am Ende wieder geschlossen werden.
  $conn->die();
?>

<?php
#error_reporting(E_ALL);
// unsere Klassen einbinden
$start = microtime();
include "system/classes/frontend_controller.php";
include "system/classes/frontend_model.php";
include "system/classes/frontend_view.php";

// $_GET und $_POST zusammenfasen  
$request = array_merge($_GET, $_POST);
// Controller erstellen
$controller = new Controller($request);
// Inhalt der Webanwendung ausgeben.
echo $controller->display();
$ende = microtime();
$zeit = $ende-$start;
#echo $zeit;
?>
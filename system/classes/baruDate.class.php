<?php
/*
Name: baruDate.class.php
Dateipfad: /system/classes
Version: 1.1
Erstellt: 23.4.2013
Letzte wichtige Änderung: 30.4.2013
	- Anpassung für MVC (__construct())
Autoren: Felix Deil
Beschreibung: Wandelt einen Timestamp in das gewünschte Format um
ToDo:
	- Auswahlmöglichkeit

(c) Felix Deil 2013
Diese Klasse ist Teil von BaruCMS.
*/
class baruDate
{
	private $timestamp;
	private $format = "";
	public function __construct($timestamp)
	{
		$this->timestamp = $timestamp;
	}
	
	public function returnDate()
	{
		$result = date("d.m.Y - H:i", $this->timestamp);
		return $result;
	}
}
?>
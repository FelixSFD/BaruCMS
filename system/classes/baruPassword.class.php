<?php
/*
Name: baruPassword.class.php
Dateipfad: /system/classes
Version: 1.0.1
Erstellt: 23.4.2013
Letzte wichtige Änderung: 24.4.2013
	- passwort wird jetzt auch überprüft ;-)
Autoren: Felix Deil
Beschreibung: Erzeugt einen komplizierten hash eines Passworts
ToDo:

(c) Felix Deil 2013
Diese Klasse ist Teil von BaruCMS.
*/
class baruPassword
{
	private $email; # Usereingabe
	private $password; # Usereingabe
	private $userID; # aus DB ausgelesen
	private $registrationDate; # aus DB ausgelesen
	private $salt1; # aus ID berechnet
	private $salt2; # aus ID berechnet
	private $salt3; # aus Datum der Registrierung berechnet
	
	private function getUserID()
	{
		global $rootPath;
		include $rootPath."/db_config.php";
		include $rootPath."/system/mysqli_connect.php";
		$userIDQuery = $db->query("SELECT * FROM ".$db_prefix."User WHERE Email = '".$this->email ."'");
		$userIDResult = $userIDQuery->fetch_object();
		$this->userID = $userIDResult->ID; # userID speichern
		$this->registrationDate = $userIDResult->RegistrationDate; # Datum der Registrierung speichern
		$this->salt1 = hash("SHA512", $this->userID); # Salt 1 berechnen
		$this->salt2 = hash("md5", $this->userID); # Salt 2 berechnen
		$this->salt3 = hash("md5", $this->registrationDate); # Salt 3 berechnen
	}

	public function hashPassword($mail, $pw)
	{
		$this->email = $mail; # E-Mail sichern
		$this->password = $pw; # Passwort sichern
		$this->getUserID(); # UserID herausfinden und die dazugehörigen salts berechnen
		$passwordHashed = $this->password .$this->salt1;
		$passwordHashed = hash("SHA256", $passwordHashed); # hash Stufe 1
		$passwordHashed = hash("md5", $this->salt2 .$passwordHashed); # hash Stufe 2
		$passwordHashed = hash("SHA512", $passwordHashed.$this->salt3); # hash Stufe 3
		return $passwordHashed; # hash zurückgeben
	}
}
?>
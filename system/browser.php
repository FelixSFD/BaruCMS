<?php

//Betriebssystem ermitteln
$agents = $_SERVER['HTTP_USER_AGENT'];
/*if($_GET["browser"] == "ja"){
	echo $_SERVER['HTTP_USER_AGENT'];
}*/
//Browser ermitteln
	if (strpos($agents, "Firefox/18.0")) {
        $browser = "Firefox 18";
		$html5 = "1";
    }
	if (strpos($agents, "Firefox/17.0")) {
        $browser = "Firefox 17";
		$html5 = "1";
    }
	if (strpos($agents, "Firefox/16.0")) {
        $browser = "Firefox 16";
		$html5 = "1";
    }
	if (strpos($agents, "Firefox/15.0")) {
        $browser = "Firefox 15";
		$html5 = "1";
    }
	if (strpos($agents, "Firefox/14.0")) {
        $browser = "Firefox 14";
		$html5 = "1";
    }
	if (strpos($agents, "Firefox/13.0")) {
        $browser = "Firefox 13";
		$html5 = "1";
    }
	if (strpos($agents, "Firefox/12.0")) {
        $browser = "Firefox 12";
		$html5 = "1";
    }
	
	if (strpos($agents, "Firefox/11.0")) {
        $browser = "Firefox 11";
		$html5 = "1";
    }
	
	if (strpos($agents, "Firefox/10.0")) {
        $browser = "Firefox 10";
		$html5 = "1";
    }

	if (strpos($agents, "Firefox/9.0")) {
        $browser = "Firefox 9";
		$html5 = "1";
    }
	
	if (strpos($agents, "Firefox/8.0")) {
        $browser = "Firefox 8";
		$html5 = "1";
    }
	
	if (strpos($agents, "Firefox/7.0")) {
        $browser = "Firefox 7";
		$html5 = "1";
    }
	
	if (strpos($agents, "Firefox/6.0")) {
        $browser = "Firefox 6";
		$html5 = "1";
    }

    if (strpos($agents, "Mozilla/5.0")) {
        $browser = "Mozilla";
		$html5 = "1";
    }
    if (strpos($agents, "Mozilla/4")) {
        $browser = "Netscape";
		$html5 = "1";
    }
    if (strpos($agents, "Mozilla/3")) {
        $browser = "Netscape";
    }
    /*if (strpos($agents, "Firefox") || strpos($agents, "Firebird")) {
        $browser = "Firefox";
    }*/
	if (strpos($agents, "MSIE 10.0")) {
        $browser = "Internet Explorer 10";
		$ie = "2";
		$html5 = "1";
    }
	if (strpos($agents, "MSIE 9.0")) {
        $browser = "Internet Explorer 9";
		$ie = "2";
		$html5 = "1";
    }
    if (strpos($agents, "MSIE 8.0")) {
        $browser = "Internet Explorer 8";
		$ie = "1";
		$html5 = "1";
    }
    if (strpos($agents, "MSIE 7.0")) {
        $browser = "Internet Explorer 7";
		$ie = "1";
    }
    if (strpos($agents, "MSIE 6.0")) {
        $browser = "Internet Explorer 6";
		$ie = "1";
    }
    if (strpos($agents, "MSIE 5.0")) {
        $browser = "Internet Explorer 5";
		$ie = "1";
    }
    if (strpos($agents, "Netscape")) {
       $browser = "Netscape";
    }
    if (strpos($agents, "Safari") && !strpos($agents, "iPhone")) {
        $browser = "Safari";
		$html5 = "1";
    }
	if (strpos($agents, "Safari") && strpos($agents, "iPhone")) {
        $browser = "Mobile Safari";
		if(strpos($agents, "iPod;")){
			$handy = "den iPod touch";
		}
		if(strpos($agents, "iPhone;")){
			$handy = "das iPhone";
		}
		if(strpos($agents, "iPad;")){
			$handy = "das iPad";
		}
		$html5 = "1";
		$iOS = true;
    }
	if (strpos($agents, "Android")) {
        $browser = "Android";
		$android = "1";
    }
    if (strpos($agents, "Opera")) {
        $browser = "Opera";
		$html5 = "1";
    }
	if (strpos($agents, "Chrome/22")) {
        $browser = "Google Chrome 22";
		$html5 = "1";
    }
	if (strpos($agents, "Chrome/21")) {
        $browser = "Google Chrome 21";
		$html5 = "1";
    }
	if (strpos($agents, "Chrome/20")) {
        $browser = "Google Chrome 20";
		$html5 = "1";
    }
	if (strpos($agents, "Chrome/19")) {
        $browser = "Google Chrome 19";
		$html5 = "1";
    }
	if (strpos($agents, "Chrome/18")) {
        $browser = "Google Chrome 18";
		$html5 = "1";
    }
	if (strpos($agents, "Chrome/17")) {
        $browser = "Google Chrome 17";
		$html5 = "1";
    }
	if (strpos($agents, "Chrome/16")) {
        $browser = "Google Chrome 16";
		$html5 = "1";
    }
    if (!isset($browser)) {
        $browser = "Unbekannt";
    }
	//Betriebssystem
	if (strpos($agents, "Windows NT 6.1")) {
        $os = "Windows 7";
    }
	if (strpos($agents, "Windows NT 6.0")) {
        $os = "Windows Vista";
    }
	if (strpos($agents, "Googlebot")) {
        $browser = "Googlebot";
		$os = "Googlebot";
    }

//Browser ausgabe
  //echo "Dein Browser ist: ".$agents;

?>
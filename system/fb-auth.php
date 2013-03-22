<?php
$app_id = "225463167580375";
$app_secret = "e710fa0e301c00d159b4230df7a0d878";

$my_url = "http://".$_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"];

$code = $_REQUEST["code"];

if(empty($code)) {
	$_SESSION['state'] = md5(uniqid(rand(), TRUE)); 
	$_SESSION['nonce'] = md5(uniqid(rand(), TRUE)); // New code to generate auth_nonce
	$dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
		. $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
		. $_SESSION['state']."&auth_type=https&scope=email&auth_nonce="
		. $_SESSION['nonce']; // Modified dialog_url to add auth_type and auth_nonce;

	echo("<script> document.location.href='" . $dialog_url . "'</script>");
}

if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
	if($_REQUEST['auth_nonce'] && ($_REQUEST['auth_nonce'] === $_SESSION['nonce'])) {
		// New 'if' condition added to check auth_nonce

		$token_url = "https://graph.facebook.com/oauth/access_token?"
			. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
			. "&client_secret=" . $app_secret . "&code=" . $code;

		$response = file_get_contents($token_url);
		$params = null;
		parse_str($response, $params);

		$_SESSION['access_token'] = $params['access_token'];

		$graph_url = "https://graph.facebook.com/me?access_token=" 
			. $params['access_token'];

		$fb_user = json_decode(file_get_contents($graph_url));
		$_SESSION["fb-active"] = true;
		#echo("Hello " . $fb_user->name);
		#echo("<br><a href='logout.php'>Click to log out</a>");
		}
		else {
			echo("The auth_nonce does not match. This may be caused by a replay attack.");
	}
}
else {
	echo("The state does not match. You may be a victim of CSRF.");
}
?>
<?php
session_start();
include "../system/fb-auth.php";
?>
<body onload="parent.document.getElementById('fbframe').style.height=(document.getElementById('content').offsetHeight+55)+'px'">
	<div id="content">
		<?php
		echo '
			<img align=left src="https://graph.facebook.com/'.$fb_user->id .'/picture?type=normal">
			<b>'.$fb_user->name .'</b> ('.$fb_user->username .')<br>
			E-Mail: '.$fb_user->email .'<br>
			ID: '.$fb_user->id .'<br>
			<small><a href="yourAccount_fb_disconnect.php?fb='.$fb_user->id .'">Verbindung trennen</a></small>
		';
		?>
	</div>
</body>
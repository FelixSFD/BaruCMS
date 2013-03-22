<center>
	<form method="post" id="loginForm" action="admin.php?login=true">
		<label for="email"><b><? echo $lang_email; ?></b></label><br>
		<input type="email" id="email" name="email" placeholder="<? echo $lang_username; ?>" size="35"><br>
		<label for="pw"><b><? echo $lang_password; ?></b></label><br>
		<input type="password" id="pw" name="pw" placeholder="<? echo $lang_password; ?>" size="35"><br>
		<input type="checkbox" id="save" name="save"><label for="save"><? echo $lang_stayLoggedIn; ?></label><br>
		<button type="submit" style="display:none;"><? echo $lang_login; ?></button>
	</form>
	<script>
	function facebook_login(){
		window.open("fbLogin.php");
	}
	</script>
	<br>or <a href="javascript:void(0);" onclick="facebook_login()">LOGIN with FACEBOOK</a>
</center>
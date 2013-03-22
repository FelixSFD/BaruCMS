<?php
if(!$ECM["login_ok"]){
	?>
	<div id="loginDialog" title="<?php echo $lang_login; ?>">
	<?php
	include "admin/loginForm.php";
	?>
	</div>
	<?
}
?>
<div id="footer">
	<center>
		<small>
			Baru CMS BETA by Felix Deil
			<?php
			$menuFooter = mysql_query("SELECT * FROM ".$db_prefix."Menu WHERE Sichtbarkeit = 1 AND mainMenu = -1", $mysql);
			if(mysql_error()){
				fehler(mysql_error());
			}
			while($mFooter = mysql_fetch_array($menuFooter)) {
				if(substr($mFooter["Link"], 0, 7) == "http://"){
					?>
					 - <a href="go.php?url=<?php echo $mFooter["Link"]; ?>" target="_blank"><?php echo $mFooter["Titel"]; ?></a>
					<?php
				} else {
					?>
					 - <a href="<?php echo $mFooter["Link"]; ?>"><? echo $mFooter["Titel"]; ?></a>
					<?php
				}
			}
			
			if($ECM["login_ok"]){
				?>
				 - <a href="admin.php" target="_blank"><?php echo $lang_adminbereichTitle; ?></a>
				 - <a href="index.html" onclick="logout()">[<?php echo $lang_adminMenueElementLogout; ?>]</a>
				<?php
			} else {
				?>
				 - <a href="#" onclick="loginForm()"><?php echo $lang_login; ?></a>
				<?php
			}
			?>
		</small><br>
		<?php
		$ladezeitEnde = microtime(true);
		$ladezeit = $ladezeitEnde-$ladezeitStart;
		//echo round($ladezeit, 4);
		?>
	</center>
</div>
<?php
if($ladezeit > 0.5 && $ECM["login_ok"]){
	?>
	<script>
	function closeSlowInfo(){
		$("#slowInfo").fadeOut("normal");
		document.cookie="slowInfoBox=1";
	}
	</script>
	<?php
	if(!$_COOKIE["slowInfoBox"]){
	?>
		<div id="slowInfo">
			<small><a onclick="closeSlowInfo()" href="#" class="closeX">[x]</a></small><br>
			<b>&nbsp;&nbsp;&nbsp;Your server seems to be too slow for Baru CMS!&nbsp;&nbsp;&nbsp;</b>
		</div>
	<?php
	}
}
?>
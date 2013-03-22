<h1><?php echo $lang_search; ?></h1>
<?php
if($_GET["action"] == "submit"){
	if(setSetting("SEARCH_ACTIVE", $_POST["searchActive"])){

	} else {
		fehler(mysql_error());
	}
	
	if(setSetting("SEARCH_MIN_LENGTH", $_POST["searchMinLength"])){

	} else {
		fehler(mysql_error());
	}
}
?>
<form method="post" action="?p=search-settings&action=submit">
	<table>
		<tr>
		<td><label for="searchActive"><?php echo $lang_searchActive; ?></label></td>
			<td>
				<?php
				if(getSetting("SEARCH_ACTIVE") == "1"){
					?>
					<input type="checkbox" name="searchActive" id="searchActive" value="1" checked />
					<?php
				} else {
					?>
					<input type="checkbox" name="searchActive" id="searchActive" value="1" />
					<?php
				}
				?>
			</td>
		</tr>
		<tr>
		<td><label for="searchMinLength"><?php echo $lang_searchMinLength; ?></label></td>
			<td>
				<input type="number" id="searchMinLength" name="searchMinLength" value="<?php echo getSetting("SEARCH_MIN_LENGTH"); ?>">
			</td>
		</tr>
		<tr>
			<td></td>
			<td><button class="custom"><?php echo $lang_save; ?></button></td>
		</td>
	</table>
</form>
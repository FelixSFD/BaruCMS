<ul id="main-menu">
	<li><a href="index.html"><? echo $lang_startseite; ?></a></li>
	<?
	$menu = mysql_query("SELECT * FROM ".$db_prefix."Menu WHERE Sichtbarkeit = 1 AND mainMenu = 0", $mysql);
		if(mysql_error()){
			fehler(mysql_error());
		}
		while($m = mysql_fetch_array($menu)) {
			?>
			<li class="layer1 closed" data-id="<? echo $m["ID"]; ?>" data-status="closed">
				<a href="<? echo $m["Link"]; ?>"><? echo $m["Titel"]; ?></a>
				<?
				$menu2counter = mysql_query("SELECT * FROM ".$db_prefix."Menu WHERE Sichtbarkeit = 1 AND mainMenu = ".$m["ID"], $mysql);
				while($m2counter = mysql_fetch_array($menu2counter)) {
					$anzahl2++;
				}
				if($anzahl2 >= 1){
					?>
					<ul class="layer2">
						<?
						$menu2 = mysql_query("SELECT * FROM ".$db_prefix."Menu WHERE Sichtbarkeit = 1 AND mainMenu = ".$m["ID"], $mysql);
						while($m2 = mysql_fetch_array($menu2)) {
							?>
							<li>
								<a href="<? echo $m2["Link"]; ?>"><? echo $m2["Titel"]; ?></a>
								<?
								$menu3counter = mysql_query("SELECT * FROM ".$db_prefix."Menu WHERE Sichtbarkeit = 1 AND mainMenu = ".$m2["ID"], $mysql);
								while($m3counter = mysql_fetch_array($menu3counter)) {
									$anzahl3++;
								}
								if($anzahl3 >= 1){
									?>
									<ul>
										<?
										$menu3 = mysql_query("SELECT * FROM ".$db_prefix."Menu WHERE Sichtbarkeit = 1 AND mainMenu = ".$m2["ID"], $mysql);
										while($m3 = mysql_fetch_array($menu3)) {
											?>
											<a href="<? echo $m3["Link"]; ?>"><? echo $m3["Titel"]; ?></a>
											<?
										}
										?>
									</ul>
									<?
								}
								$anzahl3 = 0;
								?>
							</li>
							<?
						}
						?>
					</ul>
					<?
				}
				$anzahl2 = 0;
				?>
			</li>
			<?
		}
	?>
</ul>
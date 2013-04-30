<div id="banner">
	<center><b>BETA</b></center>
</div>
<?php include "private_body_header.php"; ?>
<?php include "private_body_menu.php"; ?>
<div id="content">
	<div id="welcome">
		<?php echo $this->_["welcome"]; ?>
	</div>
<?php include $this->_["pageType"].".php"; ?>
</div>
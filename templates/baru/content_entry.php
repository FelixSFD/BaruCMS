<small><?php echo $this->_["pageData"]["Datum"]; ?>
</small>
<h1><?php echo $this->_["pageData"]["Titel"]; ?></h1>
<p><?php echo $this->_["pageData"]["Inhalt"]; ?></p>
<hr>
<small>
	Geschrieben von: <?php echo $this->_["pageData"]["AuthorInfo"]["Vorname"]." ".$this->_["pageData"]["AuthorInfo"]["Nachname"]; ?> | 
	Kategorie: <a href="?category=<?php echo $this->_["pageData"]["Category"]["ID"]; ?>"><?php echo $this->_["pageData"]["Category"]["Name"]; ?></a>
</small>
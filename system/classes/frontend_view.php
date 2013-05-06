<?php
class View
{
	private $template;
	private $pageType;
	private $_ = array();
	public function __construct($template, $pageType)
	{
		$this->template = $template;
		$this->pageType = $pageType;
	}
	
	public function assign($key, $value){  
        $this->_[$key] = $value;  
    }
	
	public function fillTemplate()
	{
		# Hauptseite
		ob_start();
		include "templates/".$this->template ."/".$this->pageType .".php";
		$result = ob_get_contents();
		ob_end_clean();
		return html_entity_decode($result);
	}
}
?>
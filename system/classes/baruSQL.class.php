<?php
class baruSQL
{
	private $query;
	private $type = "MySQL"; # Standarteinstellung __construct() kann das ändern
	private $returnType;
	private $error;
	public function __construct($query)
	{
		$this->query = $query;
		if(extension_loaded('mysqli')){
			$this->type = "MySQLi";
		}
	}
	
	public function sqlError()
	{
		return $this->error;
	}

	public function returnData($returnType)
	{
		global $rootPath;
		global $db;
		global $mysql;
		$this->returnType = $returnType;
		
		switch($this->type){
			case "MySQLi":
				#echo $this->query;
				include $rootPath."/db_config.php";
				include $rootPath."/system/mysqli_connect.php";
				$SQLquery = $db->query($this->query);
				if(mysqli_error($db)){
					$this->error = mysqli_error($db);
					echo $this->error;
				}
				switch($this->returnType){
					case "array":
						$n = 0;
						while($r = $SQLquery->fetch_array()){
							$result[$n] = $r;
							$n++;
						}
						break;
					case "object":
						$n = 0;
						while($r = $SQLquery->fetch_object()){
							$result[$n] = $r;
							$n++;
						}
						break;
				}
				
				break;
			case "MySQL":
				include $rootPath."/db_config.php";
				include $rootPath."/system/mysql_connect.php";
				$SQLquery = mysql_query($this->query, $mysql);
				switch($this->returnType){
					case "array":
						$n = 0;
						while($r = mysql_fetch_array($SQLquery)){
							$result[$n] = $r;
							$n++;
						}
						break;
					case "object":
						$n = 0;
						while($r = mysql_fetch_object($SQLquery)){
							$result[$n] = $r;
							$n++;
						}
						break;
				}
				break;
		}
		return $result;
	}
	
	public function execute()
	{
		global $rootPath;
		switch($this->type){
			case "MySQLi":
				global $db;
				$db->query($this->query);
				if(mysqli_error($db)){
					$this->error = mysqli_error();
				}
				break;
			case "MySQL":
				global $mysql;
				mysql_query($this->query);
				if(mysql_error()){
					$this->error = mysql_error();
				}
				break;
		}
		if($this->error){
			return false;
		} else {
			return true;
		}
	}
}
?>
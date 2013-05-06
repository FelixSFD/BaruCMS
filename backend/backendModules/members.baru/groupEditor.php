<?php
include "../../../adminAPI.php";
/*$groupsQuery = $db->query("SELECT * FROM ".$db_prefix."Groups WHERE ID = '".$_GET["groupID"]."'");
$groupsResult = $groupsQuery->fetch_object();*/

$groups = new baruSQL("SELECT * FROM ".$db_prefix."Groups WHERE ID = '".$_GET["groupID"]."'");
$groupsResult = $groups->returnData("array");

$allRights = array("EDIT_USER", 
	"EDIT_USERGROUPS",
	"EDIT_PAGES",
	"UPDATE_SETTINGS",
	"UPDATE_SYSTEM",
	"VIEW_SYSTEM_INFO");
$allRightsNames = array("Benutzer verwalten", 
	"Benutzergruppen verwalten",
	"Seiten verwalten",
	"Einstellungen &auml;ndern",
	"Systemupdates durchf&uuml;hren",
	"Systeminformationen ansehen");

class rightsTable
{
	private $result;
	public $groupID;
	public $db;
	private function getStatus($code){
		global $rootPath;
		include $rootPath."/db_config.php";
		$rights = new baruSQL("SELECT * FROM ".$db_prefix."Rights WHERE GroupID = '".$this->groupID."' AND Name = '".$code."'");
		$rightsResult = $rights->returnData("array");
		return $rightsResult[0]["Name"];
	}
	public function writeTableLine($code, $name){
		$this->result .= '<tr>';
		$this->result .= '<td><label for="'.$code .'">'.$name .'</label></td>';
		if($this->getStatus($code)){
			$this->result .= '<td><input type="checkbox" id="'.$code .'" value="'.$code .'" checked></td>';
		} else {
			$this->result .= '<td><input type="checkbox" id="'.$code .'" value="'.$code .'"></td>';
		}
		$this->result .= '</tr>';
	}
	
	public function returnFullTable(){
		return $this->result;
	}
}
?>
<table>
	<tr>
		<td><label for="groupname">Gruppenbezeichnung:</label></td>
		<td><input type="text" id="groupname" value="<?php echo $groupsResult[0]["Name"]; ?>"></td>
	</tr>
	<?php
	$rightsTable = new rightsTable;
	$rightsTable->db = $db;
	$rightsTable->groupID = $_GET["groupID"];
	$n = 0;
	foreach($allRights as $right){
		$rightsTable->writeTableLine($right, $allRightsNames[$n]);
		$n++;
	}
	echo $rightsTable->returnFullTable();
	?>
	<tr>
		<td><input type="hidden" id="groupID" value="<?php echo $_GET["groupID"]; ?>"></td>
		<td><button class="ui-state-default ui-corner-all" onclick="saveGroup()">Speichern</button><span id="ajaxStatus2"></span></td>
	</tr>
</table>
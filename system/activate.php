<?
$licenseCode[0] = $_GET["new"]; 
$handle_code = fopen("license.txt", "w");
fwrite($handle_code, implode('',$licenseCode));

?>
<script>
document.location.href = "admin.php";
</script>
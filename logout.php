<?php
setcookie("ECM_id", "", time()-time()*99, "/");
?>
<script>
opener.location.reload();
setTimeout("window.close();", 2500);
</script>
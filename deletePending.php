<?php
include "config.php";
$id=$_GET["id"];
mysqli_query($conn, "delete from cart where id=$id");
?>
<script type="text/javascript">
window.location="admin.php";
alert("An item has been successfully deleted.");
</script>
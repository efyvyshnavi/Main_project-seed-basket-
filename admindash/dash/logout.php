<?php
session_start();
$_SESSION['email']=="";
session_unset();
//session_destroy();
$_SESSION['errmsg']="You have successfully logout";
?>
<script language="javascript">
document.location="../../../../../../vs/admin/seedportal/shopping/login.php";
</script>

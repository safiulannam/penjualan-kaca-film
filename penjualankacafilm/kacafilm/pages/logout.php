<?php
session_start();

session_unset();

session_destroy();

echo "
<script>
alert('Kamu Berhasil Logout');
document.location.href = 'login.php';
</script>
";

exit;

?>
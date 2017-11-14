<html><body>
<?php
session_start();
session_destroy();
header('Location: shoppingcart.php');
?>
</body></html>
<?php
session_start();
unset($_SESSION["account"]);
unset($_SESSION["pw"]);
session_destroy(); 
header("Location: login.php");
?>
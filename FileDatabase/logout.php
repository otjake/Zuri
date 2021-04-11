<?php
session_start();

//destroy session

session_destroy();

header("Location:login.php");
?>

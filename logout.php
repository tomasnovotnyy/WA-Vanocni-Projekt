<?php
// Zahájení session
session_start();

// Zničení všech dat v session
session_destroy();

// Přesměrování na index.php
header("Location: index.php");

// Ukončení skriptu
exit();
?>

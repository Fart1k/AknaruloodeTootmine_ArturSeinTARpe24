<?php
session_start();

// Kui kasutaja ei ole veel loginud sisse teda suunatakse login lehele
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

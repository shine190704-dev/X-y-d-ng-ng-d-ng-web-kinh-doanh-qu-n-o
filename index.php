<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


require_once __DIR__ . '/database.php';


require_once __DIR__ . '/views/layout/header.php';



require_once __DIR__ . '/views/layout/footer.php';

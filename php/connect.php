<?php
    if (!isset($indirect)) {
        die('Nie można było przetworzyć tego żądania');
    } else {
        define('DB_SERVER', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', '');
        define('DB_DATABASE', 'beTogether');
        $server = 'localhost';
        $db = 'beTogether';
        $user = 'root';
        $pwd = '';
    }
?>
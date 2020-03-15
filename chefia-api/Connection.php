<?php
    try {
        $pdo = new PDO("mysql:host=127.0.0.1;dbname=chefia_db;", "root", "");
    } catch (PDOException $dbError) {
        echo "Ocorreu um problema com o banco de dados.\n\n" . $dbError;
        exit();
    }
?>
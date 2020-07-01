<?php
    try {
        $pdo = new PDO("mysql:host=mysql.chefia.darlinton.net;dbname=chefiadb;", "chefiadb", "cca*9*kNdYTh9KM");
    } catch (PDOException $dbError) {
        echo "Ocorreu um problema com o banco de dados.\n\n" . $dbError;
        exit();
    }
?>

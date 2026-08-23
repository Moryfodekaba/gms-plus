<?php
/**
 * GMS PLUS - Connexion à la base de données
 * Compatible XAMPP (MySQL/MariaDB via PDO)
 */

define('DB_HOST', 'gms-plus.gt.tc');
define('DB_NAME', 'gms_plus');
define('DB_USER', 'root');
define('DB_PASS', ''); // Mot de passe par défaut XAMPP = vide

function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données. Vérifiez que MySQL est démarré dans XAMPP et que la base "gms_plus" a été importée. Détail : ' . htmlspecialchars($e->getMessage()));
        }
    }
    return $pdo;
}

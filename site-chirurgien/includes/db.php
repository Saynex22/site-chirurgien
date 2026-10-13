<?php
// Paramètres de connexion
$db_hote         = 'localhost';
$db_port         = '3306';
$db_nom          = 'chirurgien';
$db_utilisateur  = 'root';
$db_mot_de_passe = '';

$dsn = "mysql:host=$db_hote;port=$db_port;dbname=$db_nom;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_utilisateur, $db_mot_de_passe, $options);
} catch (PDOException $erreur) {
    // Pas de détail technique affiché au visiteur
    http_response_code(500);
    exit('Connexion à la base de données impossible.');
}

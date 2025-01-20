<?php
$host = "localhost";
$database = "luminess";
$username = "root";
$mdp = "";

try {
    // Correction de la chaîne de connexion
    $pdo = new PDO("mysql:host=".$host.";dbname=".$database.";charset=utf8", $username, $mdp);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

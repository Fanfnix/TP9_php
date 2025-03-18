<?php
$servername = "localhost";   // Nom du serveur
$username = "root";   // Nom d'utilisateur de la base de données
$password = "";   // Mot de passe de la base de données
$dbname = "TP9";   // Nom de la base de données

try {
    $dbPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration de PDO pour générer des exceptions en cas d'erreur
    $dbPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données<br>"; 
} catch(PDOException $e) {
    echo "La connexion a échouée : " . $e->getMessage() . "<br>";
}
?>
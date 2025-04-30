<?php
$host = 'mysql-container';  // Nom du service MySQL dans Docker
$dbname = 'maison_du_livre';  // Nom de la base de données
$username = 'root';  // Utilisateur MySQL
$password = 'rootpassword';  // Mot de passe root défini dans docker-compose.yml

try {
    // Connexion via PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données 'maison_du_livre'!";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>

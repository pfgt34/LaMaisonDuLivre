<?php
include 'connexion.php';  // Inclure la connexion à la base de données

// Données à insérer
$titre = 'Le Petit Prince';
$auteur = 'Antoine de Saint-Exupéry';
$genre = 'Roman';
$date_publication = '1943-04-06';
$quantité_disponible = 5;
$type_document = 'Livre imprimé';

// Requête SQL pour insérer un livre
$sql = "INSERT INTO livre (titre, auteur, genre, date_publication, quantité_disponible, type_document)
        VALUES (?, ?, ?, ?, ?, ?)";

// Préparer et exécuter la requête
$stmt = $pdo->prepare($sql);
$stmt->execute([$titre, $auteur, $genre, $date_publication, $quantité_disponible, $type_document]);

echo "Livre ajouté avec succès!";
?>

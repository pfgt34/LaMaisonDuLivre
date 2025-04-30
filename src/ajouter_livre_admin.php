<?php
include 'connexion.php';  // Connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $genre = $_POST['genre'];
    $quantité_disponible = $_POST['quantité_disponible'];

    // Requête SQL pour insérer un nouveau livre
    $sql = "INSERT INTO livre (titre, auteur, genre, quantité_disponible)
            VALUES (?, ?, ?, ?)";

    // Préparer et exécuter la requête
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $auteur, $genre, $quantité_disponible]);

    echo "Livre ajouté avec succès!";
}
?>

<?php
include 'connexion.php';  // Connexion à la base de données

// Vérifier si l'ID de l'emprunt est fourni
if (isset($_GET['id'])) {
    $id_emprunt = $_GET['id'];

    // Requête SQL pour marquer l'emprunt comme retourné
    $sql = "UPDATE emprunts SET date_retour = NOW() WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_emprunt]);

    echo "Emprunt retourné avec succès!";
}
?>

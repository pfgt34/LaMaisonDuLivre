<?php
include 'connexion.php';  // Connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_livre = $_POST['id_livre'];
    $id_abonnement = $_POST['id_abonnement'];

    // Requête SQL pour insérer un emprunt
    $sql = "INSERT INTO emprunts (id_livre, id_abonnement)
            VALUES (?, ?)";

    // Préparer et exécuter la requête
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_livre, $id_abonnement]);

    echo "Emprunt enregistré avec succès!";
}
?>

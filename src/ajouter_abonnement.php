<?php
include 'connexion.php';  // Connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $type_abonnement = $_POST['abonnement'];

    // Requête SQL pour insérer un nouvel abonnement
    $sql = "INSERT INTO abonnements (nom, email, type_abonnement)
            VALUES (?, ?, ?)";

    // Préparer et exécuter la requête
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $email, $type_abonnement]);

    echo "Abonnement ajouté avec succès!";
}
?>

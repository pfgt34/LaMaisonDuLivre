<?php
session_start();
include 'connexion.php';  // Connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Requête SQL pour récupérer l'utilisateur avec ce nom d'utilisateur
    $sql = "SELECT * FROM utilisateurs WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($user && password_verify($password, $user['password'])) {
        // Vérifier le rôle (admin)
        if ($user['role'] == 'admin') {
            // Démarrer la session et rediriger vers la page d'administration
            $_SESSION['admin'] = true;
            $_SESSION['username'] = $username;
            header('Location: admin.php');
            exit;
        } else {
            echo "Vous devez être administrateur pour accéder à cette page.";
        }
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

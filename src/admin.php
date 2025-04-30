<?php
session_start();

// Vérifier si l'utilisateur est connecté et si c'est un administrateur
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - La Maison du Livre</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Bienvenue dans l'administration de La Maison du Livre</h1>
        <nav>
            <ul>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="livres.html">Nos Livres</a></li>
                <li><a href="abonnements.html">Abonnements</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="logout.php">Se déconnecter</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Page d'administration</h2>
        <p>Bienvenue, <?php echo $_SESSION['username']; ?> ! Vous avez accès à l'interface d'administration.</p>
        <!-- Ajouter des fonctionnalités d'administration ici -->
    </main>

    <footer>
        <p>&copy; 2025 La Maison du Livre - Tous droits réservés.</p>
    </footer>
</body>
</html>

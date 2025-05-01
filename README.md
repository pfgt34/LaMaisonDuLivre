La Maison du Livre - README
Ce projet consiste en une médiathèque en ligne appelée La Maison du Livre, où les utilisateurs peuvent consulter des livres, s'abonner et gérer leur abonnement. L'administrateur peut également gérer les livres, les abonnements et les emprunts.

Prérequis
Avant de commencer, assure-toi d'avoir les éléments suivants installés sur ton ordinateur :

Docker (pour le déploiement local avec un environnement de conteneur)

Télécharge et installe Docker depuis le site officiel de Docker.

Apache et PHP (via Docker)

Apache pour héberger le site.

PHP pour exécuter les scripts côté serveur.

Base de données MySQL ou MariaDB (via Docker ou installation locale)

Utilisé pour stocker les informations des utilisateurs, livres, emprunts, etc.

Étape 1 : Cloner le projet
Cloner le projet dans ton répertoire local :

bash
git clone https://github.com/pfgt34/maison-du-livre.git
cd maison-du-livre
Étape 2 : Configuration de Docker
2.1. Créer un fichier Dockerfile et docker-compose.yml
Assure-toi d'avoir un fichier Dockerfile pour configurer l'image Docker avec Apache et PHP, ainsi qu'un fichier docker-compose.yml pour gérer le conteneur Docker.

Dockerfile :
dockerfile
# Utilisation de l'image officielle PHP avec Apache
FROM php:8.2-apache

# Copie du projet dans le conteneur
COPY ./html /var/www/html
COPY ./src /var/www/src
COPY ./css /var/www/css

# Configuration Apache
RUN a2enmod rewrite

# Installation des extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql
docker-compose.yml :
yaml
version: "3.8"

services:
  apache-php:
    image: php:8.2-apache
    container_name: apache-container
    ports:
      - "8080:80"  # Mappage des ports (localhost:8080)
    volumes:
      - ./html:/var/www/html
      - ./src:/var/www/src
      - ./css:/var/www/css
    environment:
      - APACHE_DOCUMENT_ROOT=/var/www/html
    networks:
      - app-network

2.2. Démarrer Docker
Ensuite, dans le terminal, exécute les commandes suivantes pour démarrer ton environnement Docker :

bash
docker-compose up --build
Cette commande va créer les conteneurs Docker nécessaires, installer Apache, PHP et mapper ton code dans les conteneurs.

Une fois le processus terminé, tu devrais pouvoir accéder au site à l'adresse suivante :

bash
http://localhost:8080/maison_du_livre/html/login.html

Étape 3 : Configuration de la base de données
3.1. Créer la base de données
Avant de faire fonctionner le site, tu dois créer une base de données MySQL pour stocker les informations des utilisateurs, des livres, des emprunts, etc.


SQL pour la table utilisateurs :
sql
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    email VARCHAR(255) NOT NULL
);
SQL pour la table abonnements :
sql
CREATE TABLE abonnements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    type_abonnement ENUM('mensuel', 'annuel') NOT NULL,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);
SQL pour la table livre :
sql
CREATE TABLE livre (
    id_livre INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    auteur VARCHAR(255) NOT NULL,
    genre VARCHAR(255),
    quantité_disponible INT NOT NULL
);
SQL pour la table emprunts :
sql
CREATE TABLE emprunts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_livre INT,
    id_abonnement INT,
    date_emprunt DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_retour DATETIME NULL,
    FOREIGN KEY (id_livre) REFERENCES livre(id_livre),
    FOREIGN KEY (id_abonnement) REFERENCES abonnements(id)
);
3.2. Ajouter un administrateur (root)
Tu peux ajouter un administrateur dans ta base de données avec les identifiants root et rootpassword en utilisant la requête suivante :

sql
INSERT INTO utilisateurs (username, password, role, email)
VALUES ('root', 'rootpassword', 'admin', 'admin@example.com');
3.3. Configurer la connexion à la base de données
Dans le fichier connexion.php (dans le dossier src/), assure-toi que la connexion à la base de données est bien configurée. Voici un exemple de code pour la connexion à MySQL via PDO :

php
<?php
$host = 'localhost';
$dbname = 'maison_du_livre';
$username = 'root';
$password = 'rootpassword';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
Étape 4 : Accéder au site
Une fois Docker démarré et la base de données configurée, tu peux accéder au site via localhost.

Page d'accueil : http://localhost:8080/maison_du_livre/html/index.html

Page de connexion : http://localhost:8080/maison_du_livre/html/login.html

Interface d'administration : Une fois connecté, tu seras redirigé vers admin.php pour gérer les livres, abonnements, emprunts, etc.

Étape 5 : Test et Débogage
Assure-toi que la page login.html fonctionne correctement.

Connecte-toi avec l'utilisateur root et rootpassword.

Accède à l'interface d'administration pour tester les fonctionnalités d'ajout, de suppression, et de gestion des livres, abonnements et emprunts.


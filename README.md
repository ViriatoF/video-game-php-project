# Video Game Project

Un projet de cours en PHP dans le but de mettre en place un CRUD avec authentification, le plus sécurisé possible afin de mettre en pratique ce que l'on a vu en cours.
Ce projet est un répertoire de jeux vidéo permettant de lister une game de jeux vidéos perso, d'en ajouter et d'en supprimer (à terminer).

## 🛠️ Prérequis

Avant de commencer, assure-toi d'avoir installé les éléments suivants sur ta machine :

* **PHP** (version 8.x ou supérieure recommandée)
* **Composer** (pour la gestion des dépendances)
* **Serveur Web & MySQL** (via XAMPP, MAMP, WAMP, ou Docker)
* **phpMyAdmin** (ou tout autre client base de données pour gérer MySQL)
-- (Ici, j'ai utilisé Wamp par exemple)

## 🚀 Installation

Suis ces étapes pour configurer le projet en environnement de développement local :

1. Clone le dépôt :

git clone https://github.com/ViriatoF/video-game-php-project.git

2. Rends-toi dans le dossier du projet :

cd [nom de ton dossier]

3. Installe les dépendances avec Composer :

composer install

4. Base de données

Un fichier .sql est fourni à la racine du projet (ou dans le dossier database/) pour générer la structure de la base et insérer un premier jeu de données.

Ouvre phpMyAdmin (généralement accessible via http://localhost/phpmyadmin).

Va dans l'onglet Importer, sélectionne le fichier video_games.sql de ce projet et valide.

🧪 Qualité du code
Ce projet utilise des outils pour garantir la qualité et la standardisation du code. Il est recommandé de les exécuter avant chaque commit.

Formatage du code (PHP-CS-Fixer)
Pour analyser le code et corriger automatiquement les erreurs de style (indentation, espacements, standards PSR) :

Depuis Bash :

 ./vendor/bin/php-cs-fixer check (à la racine du projet)

 ./vendor/bin/php-cs-fixer fix 

Depuis Powershell, c'est pareil mais attention au sens des "slash" qui doivent être dans ce sens -> \


📁 Structure principale

public/ : Point d'entrée de l'application (index.php) et CSS.

src/ : Code source de l'application (classes, contrôleurs, modèles) en MVC.

vendor/ : Dépendances et outils (installés via Composer).

video_games.sql : Fichiers SQL pour la structure et les données.

 
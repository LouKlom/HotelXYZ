# HOTELXYZ

Projet de gestion de réservations de chambre d'hotel

## Installation

Base de données:
  - Utilisation de Mysql/MariaDB en local. Pour cela, il faut créer une nouvelle base de donnée nommée "hotelapi" et d'importer le fichier base_export.sql du dossier BDD

BACK:
  - Installation de Symfony : https://symfony.com/doc/current/setup.html
  - Il faut configurer le fichier .env qui se trouve à la racine du projet. Dans mon cas, j'ai crée un utilisateur  spécialement pour ce projet et ai configuré ma chaine de connexion de la sorte:
    DATABASE_URL="mysql://dev:azerty@127.0.0.1:3306/hotelapi"

FRONT:
  - J'utilise un simple serveur PHP sous linux. Ce dernier est déployé sur le localhost mais avec modification du port en 8500 pour éviter les problèmes de configurations.
  - Avant de lancer le serveur PHP, il faut s'assurer que la base de données et le serveur symfony soient bien lancés:
              - Pour Symfony, accéder à l'url du serveur, dans mon cas: http://localhost:8000/
              - Pour la base de données, il peut être intéressant de consulter chaque table de la base. Un jeu de données est installé lors de l'import

  - Configuration du FRONT:
              - Depuis le dossier FRONT, accéder au fichier suivant: HOTELFRONT/functions/hotel_config.php
                    - changez les deux variables contenues dans ce fichier.
                              $adresseBDD => correspond à l'adresse du serveur symfony
                              $adresseFRONT => correspond à l'adresse du serveur PHP



Bon amusement ;)

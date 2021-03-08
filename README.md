# Websockets sous Laravel

Ce projet a été créé dans le but de mettre en évidence le protocole Websockets. Les technologies utilisées sont les suivantes :

- Laravel 8
- Bootstrap 5
- WebSockets
- Base de données SQL

## Configuration du projet

### Création / Modification du fichier .env

Pour que le projet fonctionne, il faut copier et renommé le fichier .env.exemple et fichier .env puis vous devez modifier le contenue suivant :

- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=laravel_websockets
- DB_USERNAME=root
- DB_PASSWORD=
- QUEUE_CONNECTION=database
- BROADCAST_DRIVER=pusher

### Initialisation des packages

Il faut ensuite initialiser les packages grâce aux commandes suivantes :

- composer install
- npm install

Puis on initialise la base de données et passport :

- php artisan migrate:fresh --seed
- php artisan passport:install --force

On lance le projet grâce aux commandes suivantes :

- php artisan serve
- php artisan queue:work
- php artisan websockets:serve

## Comptes de test :

Compte 1 :

- Identifiant : j.doe@gmail.com
- Mot de passe : password

Compte 2 : 

- Identifiant : a.done@gmail.com
- Mot de passe : password

## Démarche d'utilisation de l'application

Pour pouvoir utiliser cette application, il faudra ouvrir votre navigateur en normal et en privé. Une connexion sera faite par le biais de votre navigateur suivant deux types de navigation :

- Navigation normal (connexion au compte 1)
- Navigation privé (connexion au compte 2)
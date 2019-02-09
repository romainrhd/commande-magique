# Commande magique :dizzy:

Voici une commande qui permet d'installer un projet laravel avec la stack suivante :

- Docker :whale:
- MariaDB
- Nginx
- PHP FPM :elephant:

## Installation
Pour installer le projet, il faut lancer la commande suivante :
`composer global require romainrhd/installer`.

Ensuite, il faut s'assurer que le dossier bin des vendor composer soit dans votre PATH système.

Le dossier ce trouve ici dans l'installation de composer : `.composer/vendor/bin`

## Utilisation
`magique new [nom du projet]`

Idées pour la suite :boom:
-
- Permettre de choisir d'autres framework comme Symfony
- Personnalisation de la stack
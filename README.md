# Commande magique :dizzy:

Voici une commande qui permet d'installer un projet laravel avec la stack suivante :

- Docker :whale:
- MariaDB
- Nginx
- PHP FPM :elephant:

## Prérequis :

- PHP
- Composer
- Docker

## Installation
Pour installer le projet, il faut lancer la commande suivante :
`composer global require romainrhd/installer`.

Ensuite, il faut s'assurer que le dossier bin des vendor composer soit dans votre PATH système.

Le dossier se trouve dans des endroits différents suivant votre OS : 
- Sur Linux : `$HOME/.config/composer/vendor/bin`
- Sur Mac : `$HOME/.composer/vendor/bin`
- Sur Windows : `%HOME%\AppData\Roaming\Composer\vendor\bin`

## Utilisation
`magique new [nom du projet]`

## Idées pour la suite :boom:

- Permettre de choisir d'autres framework comme Symfony
- Personnalisation de la stack
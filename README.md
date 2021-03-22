# La Nîmes'alerie

Vous trouverez ici **la partie symfony full-stack** de l'application, elle contient la partie **front et back office**. La partie dashboard elle, se situe sur une application **Angular** déportée. 

#Installation

### I

Une fois le dossier cloné, vous devez dans un premier temps créer a la racine du dossier un fichier **".env.local"** dans lequel vous ajouterez une adresse de connexion a votre base de données. 

### II

Vous aller ensuite rentrer la commande suivante :

```composer install```

dans un terminal ouvert a la racine du projet. Cette commande a pour but de générer le dossier "vendor" contenant toutes les dépendences nécéssaires au projet.

###III

Quand les dépendences sont installées vous pouvez directement lancé les commandes suivante dans cette ordre :

``php bin/console doctrine:database:create``

``php bin/console doctrine:schema:update``

``php bin/console doctrine:fixtures:load -f``

### IIII

Une fois ceci éffectué, vous pouvez maintenant **toujours dans un invité de commande à la racine du projet** entrer la commande suivante : 

``symfony serve``

qui lancera un serveur local sur le port 8000.

**L'application est maintenant disponible sur votre localhost sur le port 8000**

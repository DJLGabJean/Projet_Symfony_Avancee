# Projet_Symfony_Avancee

## Prérequis

Le projet a été conçu avec l'aide de Symfony, TailwindCSS et XAMP

https://www.apachefriends.org/fr/download.html


Mettez le projet dans ce chemin "C:\xampp\htdocs __(votre projet)__"


Ensuite, exécuter dans l'ordre ces commandes pour installer les dépendances du projet  :

```bash
composer install
npm install
```

De suite, exécuter la commande pour constuire et compiler les assets avec WebPackEncore :

```bash
npm run build
```

De même, exécuter les commandes pour installer la base de données, les migrations et les fixtures

```bash
php bin/console doctrine:database:create
```

```bash
php bin/console doctrine:schema:create
```

> [!CAUTION]
> Si vous avez déjà changé des éléments en rapport avec les entités, vous êtes obligé de faire des migrations et donc de lancer ces deux commandes!

```bash
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
```

Après, exécuter la commande pour construire les fixtures de toutes les entités
```bash
php bin/console doctrine:fixtures:load
```

De même, exécuter la commande pour construire les assets de TailwindCSS :

```bash
php bin/console tailwind:build
```

Enfin, ils ne vous reste plus qu'à exécuter XAMPP pour pouvoir accéder au site web !!!!

D'autres trucs vont venir au fur à me sur de la journée...






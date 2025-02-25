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

> [!WARNING] 
> Si vous voyez que tout ne s'affiche pas correctement même après avoir exécuter la commande d'avant, utiliser cette command en plus :

```bash
php bin/console asset-map:compile
```

Enfin, il ne vous reste plus qu'à exécuter XAMPP pour pouvoir accéder au site web via ce lien :

http://localhost/Projet_Symfony_Avancee/public/home

## Droits d'utilisateurs

'ROLE_USER' est donné pour tous les utilisateurs 

**Exemple d'utilisateur** :

_Utilisateur_ : `'user@example.com`

_Mot de passe_ : `user123`


'ROLE_ADMIN' est donné uniquement à un **seul utilisateur** actuellement :

_Admin_ : `admin@example.com`

_Mot de passe_ : `admin123`

'ROLE_MANAGER' est donné uniquement à un **seul utilisateur** actuellement : 

_Manager_ : `manager@example.com`

_Mot de passe_ : `manager123`


## Commande pour importer des produits en format CSV

Pour pouvoir importer vos produits en format CSV, veuillez utiliser cette commande symfony :

php bin/console app:import-products-csv {remplacer par le nom de votre chemin de votre fichier}

**Exemple** :

```bash
php bin/console app:import-products-csv csv/products.csv
```

> [!NOTE]  
> Vous pouvez utiliser la commande d'exemple pour voir ce que cela donne






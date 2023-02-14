# Require

- Symfony 6.1 (https://symfony.com/download)
- Php 8.1 (installer Wamp pour le moment, on va passer sous docker pe)
- Composer (Composer : https://getcomposer.org/download/)
- Mailer (mailHog : https://github.com/mailhog/MailHog/releases)

## Getting started

- Clone the project
- Lancer la commande : 
```txt
 composer install
```
- Créer votre db (php bin/console d:d:c)
- Créer les migrations 
 ```txt
php bin/console make:migration
```
- Lancer les migration 
 ```txt
php bin/console doctrine:make:migrations
```
- Créer un fichier .env.local
- Lancer le serveur :
```txt
Symfony serve (il faut installer le cli symfony)
``` 
 
  Voici un exemple de fichier .env.local: 

```txt
 DATABASE_URL="mysql://root:@127.0.0.1:3306/cook?serverVersion=5.7"
 MAILER_DSN=smtp://localhost:1025/
 JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
 JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
 JWT_PASSPHRASE=coucou
```

## Récuperer la data de l'api pour remplir la table user

- lancer la command php : 
```txt
  php bin/console app:import-user 
```

## Recevoir les mails en local

- configurer le port smtp  dans le fichier .env.local, la variable d'environnement est MAILER_DNS (il faut le créer)
- lancer les workers, il faut les lancer car les mails sont asynchrones 
 ```txt
  php bin/console messenger:consume async -vv
```
- lancer votre mailer, si vous utilisez mailHog il faut seulement écrire mailhog dans le terminal.

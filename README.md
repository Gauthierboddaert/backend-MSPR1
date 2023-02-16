# Require

- docker

## Getting started

- Clone the project
- Lancer docker :
```txt
 docker compose up -d 
```
- Ouvrer votre container php et lancer les commandes suivantes : 
```txt
 docker compose exec php bash -l
 composer install
 php bin/console d:d:c
 php bin/console make:migration
 php bin/console doctrine:make:migrations
```
- Créer un fichier .env.local 
- Voici un exemple de fichier .env.local: 

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

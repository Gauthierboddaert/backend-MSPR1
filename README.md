# Require

- Symfony
- Php 8.1
- Mailer (mailHog)

## Getting started

- Clone the project
- Créer votre db (php bin/console d:d:c)
- Créer les migrations (php bin/console make:migration)
- Lancer les migration (php bin/console doctrine:make:migrations)
- Créer un fichier .env.local
 
  Voici un exemple de fichier : 

```txt
 DATABASE_URL="mysql://root:@127.0.0.1:3306/cook?serverVersion=5.7"
 MAILER_DNS= https://localhost:1025
```

## Récuperer la data de l'api pour remplir la table user

- lancer la command php bin/console app:import-user 

## Recevoir les mails en local

- configurer le port smtp  dans le fichier .env.local, la variable d'environnement est MAILER_DNS (il faut le créer)
- lancer les workers, il faut les lancer car les mails sont asynchrones (php bin/console messenger:consume async -vv)
- lancer votre mailer, si vous utilisez mailHog il faut seulement écrire mailhog dans le terminal.

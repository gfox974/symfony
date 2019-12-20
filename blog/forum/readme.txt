exercice : 
Réalisation d'un forum

db,
principalement deux tables :
    - thread ( sujets du forum ) = subject, text, createdAt, (rel users: ) author, email

    - message (commentaires)= (rel thread: ) thread, subject, (rel users: ) author, email. text, createdAt

(bonus)
    - author (utilisateurs) = name, email, password, createdAt

Features :
    - Unlog : lecture des threads, lecture des messages des threads, rechercher un subject des threads / message
    - authentifié : + poster un thread, poster un message

    ( bootswatch, fixtures pour les threads / messages via faker )


Used =
    composer create-project symfony/website-skeleton forum
    composer require doctrine/orm
    composer require --dev doctrine/doctrine-fixtures-bundle
    composer req --dev fzaninotto/faker

    php .\bin\console make:controller ForumController
    -> conf dans config/?env
    php .\bin\console doctrine:database:create

creation des entités sans relations : thread / message / author
puis les relations :
Thread -> author/email : ManyToOne @Author
Message -> thread/subject : ManyToOne @Thread
           author/email : ManyToOne @Author

php .\bin\console make:migration
php .\bin\console doctrine:migrations:migrate

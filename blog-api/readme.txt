On va créer un blog qui tape sur un api, donc creation de l'api en premier lieu :
composer create-project symfony/skeleton blog-api ( pas besoin de plus que le skeleton pour le coup)
+ utils tierces :
    postman (genre wql client - permet de faire les requetes a verbes http get put post etc)
----
puis les packages :
    composer require symfony/maker-bundle --dev
    composer require orm

php bin/console make:entity Article
-> titre : string, not nullable
-> corps : text, not nullable

----
creation de la db : blog_api
    php bin/console doctrine:database:create (se base sur la conf env)
    php bin/console doctrine:schema:create (se base sur les entités déclarées)

packages pour la serialisation/deserialize de données :
    composer require jms/serializer-bundle (sera integré comme un service par la suite)

creation d'un controller 
    php bin/console make:controller ApiController
    
    on va y creer differentes routes :
        une pour [GET] articles -> recup de tous les articles
        une pour [GET] article/id -> recup de l'article 'id'
        une pour [POST] article -> creer un nouvel article

(mise en place pseudo-rest ok)

petit crud pour la crea / update / del :
packages :
composer require form validator twig-bundle security-csrf annotations
php bin/console make:crud -> sur l'entité article
 -> api crud dispo ici apres : http://localhost:8000/article/

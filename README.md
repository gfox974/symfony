# symfony


 1 ls
   2 cd .\cacofony\
   3 ls
   4 php .\bin\console make:controller
   5 php .\bin\console debug:router

   doctrine : un genre de sequelize
   6 php .\bin\console doctrine:database:create
   7 php .\bin\console doctrine:database:create
   8 php .\bin\console make:entity

   quand on modifie une entitry ( classe ) par le biais d'entity, on peut preparer le migrate pour l'appliquer en db pour la structure
   9 php .\bin\console make:migration
  10 php .\bin\console doctrine:migrations:migrate
  11 php .\bin\console make:entity
  12 php .\bin\console make:migration
  13 php .\bin\console doctrine:migrations:migrate
  14 history

  fixture permet de generer des jeux de données dummy pour peupler la database 
  15 php .\bin\console make:fixtures
  16 composer require orm-fixtures
  17 composer require orm-fixtures
  18 php .\bin\console make:fixtures
  19 php .\bin\console doctrine:fixtures:load
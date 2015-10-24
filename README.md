# Wanderlust
1. Download Composer
curl -sS https://getcomposer.org/installer | php

2. Run Composer to create-project
php composer.phar create-project laravel/laravel Wanderlust

3. Copy files..
/app/Http/Controllers
- AdminController.php
- ImageController.php
- InstagramController.php

/app/Http/
- routes.php

/public
- js folder
- images folder
- css folder

/resources/views
- user folder
- layouts folder
- auth folder
- admin folder
- home.blade.php
- about.blade.php

4. Update database.php with database connection information(DB_HOST, DB_DATABASE, DB_USERNAME and DB_PASSWORD) for MySQL.
File found in config/database.php

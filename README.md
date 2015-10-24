# Wanderlust
This is a small Laravel application made for Sempro.

### Libaries used in this project
- Composer
- Laravel 
- Instagram API
- jQuery
- Bootstrap

## Demo
Feel free to test the application here: http://larsen-asp.no/Wanderlust/Wanderlust/public/

**Administrator Account**

Username  | Password
------------- | -------------
admin@sempro.no  | Test1234

**Test User Account**

Username  | Password
------------- | -------------
user@sempro.no  | Test1234

## Installation

1. I assume you have Composer and Laravel installed (Fresh Install)
2. Download and copy the files in this project over to your Laravel project.
3. Make sure you edit your **database.php** file in the **config** folder.
4. Run the database migrations using the **php artisan migrate** command.

## Known Bugs
- Newly registered users might experience some errors when uploading images. Logging off and on again seems to solve the issue.

## Future Improvements
- Add a column named **source** on the **images** table is from (From Device/Instagram)

# Wanderlust
This is a small Laravel application made for Sempro.

### Libaries used in this project
- Composer
- Laravel 
- Instagram API
- jQuery
- Bootstrap

### Hardware / Software
- Ubuntu 14.04.3 LTS
- Putty
- WinSCP
- Github for Windows
- phpDesigner 8

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

### What is working?
- Sign Up (Create a user).
- Users can login by email and password.
- Users can connect their instagram account.
- Users can upload images either from their device or their connected instagram account.
- Users can Log Out.
- Home / Front page will show images that has been approved by an Admin.
- Admins can open the Admin page. 
- Regular users are not able to access the Admin page
- Admins can Approve photos uploaded by the users.
- Admins can Delete photos uploaded by the users.

## Installation

1. I assume you have Composer and Laravel installed (Fresh Install)
2. Download, copy and paste the files from the repository to your Laravel project.
3. Make sure you edit your **database.php** file in the **config** folder.
4. Run the database migrations using the **php artisan migrate** command.
5. Should be good to go.

## Known Bugs
- Newly registered users might experience some errors when uploading images. Logging off and on again seems to solve the issue.

## Future Improvements
- Add a column named **source** on the **images** table is from (From Device/Instagram).
- Add more confirmation/error messages to users. When uploading instagram image it is missing completely.
- Add "loading screen" on pages where ajax is being used.
- Add the possibility to upload more images at once.
- When an Admin disapproves a photo it should be deleted (Improve the cleanup).

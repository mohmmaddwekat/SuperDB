# SuperDB
## Database Management System
#### SuperDB software system is a web application for database managers. This system will be designed to manage local databases.
#### More specifically, this system is designed to allow a database manager to create a new database, import data to the database, export db schema and data. A database manager will also be able to revert to any db snapshot he/she wants.


# Key Features
 * Add a new database connection
 * Add new tables to the database 
 * Update existing tables in a specific database
 * Import a database, either from a CSV file, SQL file, or a text file
 * Export tables in a database, either to an SQL file, or a CSV file
 * Version Control (snapshots) of tables in the database
 * Add a new user with a specific role
 * Add a new role
 * Add/edit roles permissions
 * Localization (Switch website language)
 * Apply dark mode
 * Logging


# Getting Started 
This is an example of how you may give instructions on setting up your project locally. To get a local copy up and running follow these simple example steps.

# Prerequisites
PHP and Composer should be installed:
This is how to install it if you're using Windows:
```
php composer-setup.php --install-dir=bin --filename=composer
```

# How To Use
To clone and run this application, follow the follwing instructions:
* Clone the project from this GitHub repository
* Download the project through this command of Laravel Composer
```
composer create-project laravel/laravel project
```
* Now, create a new folder in the laravel project you have just created, namely, vendor. And take the content of this folder from the project repo. Then, create a file named .env and also paste the content of this file from the project repo.
* Then you need to create a new database. Put the connection details (host, username, password) in the .env file you have already created.
* Now, you need to install the Fortify, and laravel-to-uml packages using these commands:
 ```
composer require laravel/fortify
composer require andyabih/laravel-to-uml --dev
```
* After installing the required packages, go to SuperDB\vendor\laravel\fortify\route\routes.php and replace the name (login) inside the route with (users.login)

if ($enableViews){
  Route::get('/login', [AuthenticatedSessionController::class, 'create']) 
* Then, go to SuperDB\vendor\laravel\fortify\src\Http\Controllers\NewPasswordController.php and remove the validate property applied on (email), and use this code for the password: 
] <= 'password'
      'required',
      Password::min(8) 
       ->mixedCase()
       ->letters()
       ->numbers()
       ->symbols()
       ->uncompromised()
     ],
     
* Finally, in order to let the reset password feature to run, create an account on Mailtrap, select the Laravel environment, go to .env file and paste the instructions from Mailtrap in there. Do not forget to pass any dummy email in the MAIL_FROM_ADDRESS. eg, team@test.com









# SuperDB
## Database Management System
#### SuperDB software system is a web application for database managers. This system will be designed to manage local databases.
#### More specifically, this system is designed to allow a database manager to create a new database, import data to the database, export db schema and data. A database manager will also be able to revert to any db snapshot he/she wants.

# Built with
For our frontend design, we have used the following frameworks:
* Bootstrap
* JQuery
* Ajax

For the backend:
* Laravel v.8

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
     
* Now, in order to let the reset password feature to run, create an account on Mailtrap, select the Laravel environment, go to .env file and paste the instructions from Mailtrap in there. Do not forget to pass any dummy email in the MAIL_FROM_ADDRESS. eg, team@test.com
* Finally, to run the project in your IDE:
 ```
php artisan migrate
php artisan db:seed
php artisan serve
```
Now you are ready to go and enjoy SuperDB on your browser :)!

# Implementation
#### Laravel is based on MVC (Model View Controller) Design Pattern. We have also used two other design patterns:
#### The first one, is, factory design pattern. We use this design pattern in importing a database, exporting, and the version control. This will increase the system scalability, in case a new type of files is required to be added. The factory design pattern allows us to handle any other types of files without the need of editing on the source code.
#### The second design pattern we have used, is, singleton. We have implemented it in the connection profile. Singleton design pattern allows the client to create only one instance, and so this will prevent different types of users to edit on the same file program at the same time.

### Below is the logic of our work:

#### 1. Adding a new database connection 
#### By creating a new controller called ConnectionController, we were able to connect it with two components: CreateMySQLDataBase, PDO.
#### Using a mysql server connection, the connection details (DSN, password, username) were passed through the PDO component to create the connection. In the CreateMySQLDataBase component, we were able to handle the create/release database.



#### 2. Export database/tables in the database
#### We have created a component called ExportHandler. In this component, the factory method design pattern was used in order to connect it with two other components called: ExportAsCSV, ExportAsSQL. 
#### The factory method shall be able to handle the exporting process between the two selected methods(CSV, SQL). 
#### Overall, the ExportHandler component is also connected with another component called ManageDatabase.
#### In the ManageDatabase component, two methods of exporting data are handled as follows:
#### * Exporting to CSV file
#### Data from the database will be stored in a CSV file using the “fputcsv” method. 
#### * Exporting to SQL file
#### SQL queries will be created according to data taken from the desired database. This will be done using four functions: getAllTables, createTableBySQLQuery, getAllColumns, and storeNameOfColumn. 




#### 3. Import database 
#### We have created a controller called Import Controller, connected to a component named Import Handler. This component is connected with three other components in order to handle the three types of files to be imported: ImportAsCSV, ImportAsSQL, ImportAsTXT.
#### * ImportAsCSV
#### In this component, first, get the table name using buildTableBySQLQuery function, then build the query. Then, get the data from the CSV file to create the query and insert data to the table using insertRowBySQLQuery function. Finally, creating the table using the two previous functions.

#### * ImportAsTXT
#### This component is connected with the ImportAsCSV component in order to benefit from its functions (buildTableBySQLQuery, insertRowBySQLQuery). Using the buildTableBySQLQuery, we will get data from the text file and then insert it to the database using insertRowBySQLQuery.
#### * ImportAsSQL
#### In this component, we get the data from the sql file and then by using prepare function- it prepares the query to be inserted-we were able to insert the data to the database using the execute function.


#### 4. Version Control
#### We have created a controller called Version Control, this controller is connected with a component named VersionController. 
#### In this component, we used three functions:
#### The first one, show, which will show the files that will be taken as snapshots. The second, store, this will create the snapshot for the desired file. The final function is update, this will update the data by replacing the existing data in the database with the newly added snapshot. 
#### The Version Control component is also connected with the ExportAsSQL component. 


#### 5. Add new table in the database
#### - Using insert:
#### This component is connected with a component called queryHandler. The queryHandler takes a query, splits it in order to get the type of query ( drop, insert, alter..).

#### - Using SQL query
#### This component is also connected with the queryHandler component. In the queryHandler component, mysqli query function is used to create, drop, alter, and insert a query.

#### 6. Add a new user
#### We have created a controller called User Controller. In this controller, a register function is used to create a new user with the required data. Also, the role of the user will be selected.
#### Another function is used, named, store: this will save the data registered in the database. 
#### Also, a login function is used in order to allow the user to log in his account. Authentication is used here. 
#### Finally, the destroy function is used in order to log the user out of his account.

#### 7. Add a new role with permissions
#### Using the models, we were able to apply a many-to-many relationship between the roles and permissions. Using the seeder feature, we were able to define all users permissions that would be in the system.
#### In the same seeder, we were also able to define the main four roles in our system: Super-Admin, Admin, Staff, and Reader. We assigned the permissions for each role. 
#### In the Role Controller, we have handled the edit-permission functionality. 


#### 8. Localization (Language Switch)
#### Website language shall be switched either to Arabic or English. Using Middleware, a request to switch the language is sent. A new session is created to store the new request, and then send another PUT request to this session. In this way the language is switched. The default language taken from the browser is stored in the session. 

#### 9. Exception Handling and Logging 
#### We have created a controller called ExceptionMsgHandler in order to handle our different types of exceptions. We have also defined new special exceptions such as FileException. 
#### Logging system was implemented in every step in order to allow the developer to track the run of the code, in case of success and errors.












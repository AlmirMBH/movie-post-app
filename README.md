#MOVIE APP

###APP INFO
Please note that only admins have full access to all functionality. The credentials for admins can be found in UserSeeder. One of them is:

Email: sasa@sasa.ba
Password: [password]

A Postman collection is also available (Movie-App.postman_collection.json) in the root of the project. The images are planned to be implemented for use with movies, users, and posts (work in progress).

I have also implemented commands to provide an idea of automation and acceleration of the development process. If you want to test it, follow the steps below after you set up the project.


1) open the terminal and navigate to the root of the project
2) execute: php artisan make:model Car -mcbde,
3) open the cars migration and add e.g. $table->string('name');
3) execute: php artisan migrate:fresh,
4) execute: php artisan db:seed,
5) execute: php artisan optimize,
6) execute: composer dumpautoload,
7) open the database and find "cars" table,
8) add several records,
9) Log in and the routes you can use out of hand via POSTMAN are (see them in api.php):
    - GET: api/cars/index
    - GET: api/cars/show/1
    - PUT: api/cars/update/1
    - DELETE: api/cars/delete/1
    - POST: api/cars/create
    - POST: api/cars/filter 
10) By using the endpoint "api/cars/filter," you will be able to search for cars based on their "id" and "name." If you use the "orderById" parameter and pass either 'desc' or 'asc,' you can order the records accordingly. Additionally, by including the 'pagination' parameter followed by a number (e.g., 4), you can control the number of records fetched from the database (e.g., 4 records). It's important to note that no additional actions are required to access these functionalities.

For more details, please refer to the section on "Custom Artisan Commands and Stubs" below.



###MODELS
There are 6 models in the application: User, Role, Movie, Post, favoriteMovieUser, and Image. I had initially planned to implement image upload and conversion to base64 so that they could be used with users, movies, and posts.
However, due to time constraints, I was only able to implement the Image model, including filters, CRUD operations, and tests. The implementation of the Image model was automated using custom commands (see the section on custom commands below).



###SOFT DELETE
Soft delete was implemented in all models. This is a standard practice and an extra measure to prevent any unwanted data
loss.



###ROLES
There are 3 roles seeded in the application: admin, user, and guest. The "guest" role is primarily used as an example for testing CRUD operations.



###EXCEPTIONS AND LOGS
Exception handling is performed through the SetLogMessagesAndHttpResponse class. In this class, custom responses are set, and logs are written, which can be found in the storage folder. The log files are named error.php and info.php. The purpose of these logs is to provide detailed information about any occurrences within the application.



###REPOSITORY
The application utilizes a data access layer, known as a repository, to communicate with the database. Each model has a controller, which extends a base controller that includes an interface. The base repository handles the CRUD operations, while model-specific operations are implemented in the corresponding model-specific repositories.



###SEARCH FILTER
To ensure scalability, ease of maintenance, and simplicity in adding new filters to each model, I have implemented a filter model. This filter model utilizes traits and a base filter, built on the foundation of the Eloquent builder. When a request is received by a controller, it is then directed to the corresponding model. A scope method (via the trait) is used to add a builder instance. The request is subsequently passed to the base filter, where it is looped through. The methods in the ModelFilters are named identically to the input fields. As the base filter iterates through the request, it searches for matching methods in the ModelFilter. If found, the field and value are applied accordingly. Additionally, the base filter includes pagination functionality.



###FORM REQUESTS
All inputs are validated using custom form requests. Instead of the ->all() method, ->validate() is used to ensure that only the validated inputs are used for security purposes.



###MIDDLEWARE
There are 2 middlewares in the application: CORS and AUTH. As their names suggest, they are used for handling login, logout, registration, and CORS functionality.



###POLICIES
Although policies are not part of the requirements, they have been included as a security measure. They are currently commented out. If you wish to test them, you can uncomment lines such as $this->authorize('create') in any controller. Only admins are allowed to perform CRUD operations. It's important to note that tests do not work with policies.



###TESTS
Tests have been written for all the models (although not all methods). You can start the tests by using the following command: "php artisan test." If you want to run a specific test, you can use: "php artisan test --filter UserControllerTest." The tests require an additional database. Please refer to the config/database.php file and add the necessary keys in the .env file.



###CACHING
Caching is implemented for favorite movies and is refreshed whenever a movie is added or deleted from the list. Additionally, caching is specific to each user, meaning that the cache for user ID 4 will not be affected if another user, such as user ID 6, adds or removes a movie from their list.



###SLUGS AND ROUTE MODEL BINDING
Slugs are implemented in the Posts model to demonstrate how they can be used instead of IDs. Route model binding is implemented in all "show" methods across all controllers.



###JWT
JWT user authentication has been implemented, and the APIs cannot be accessed unless a user is logged in.



=====================================================
#CUSTOM ARTISAN COMMANDS AND STUBS (Read till the end)
Custom commands are used for Creating Models, Migrations, Factories, Seeders, Controllers, and Repositories

The custom commands are designed to speed up the process of development by creating models, migrations, factories, seeders, controllers, and repositories on one command.

Usage
The commands can be run from the command line using the make:model command, with the following optional arguments:

php artisan make:model ModelName [-m] [-f] [-s] [-c] [-b] [-e]

Where ModelName is the name of your new model.

The optional flags are as follows:

-m - Create a migration for the model (customized).
-f - Create a factory for the model.
-s - Create a seeder for the model.
-c - Create a controller for the model (customized).
-b - Create a repository for the model (customized).
-d - Create a filter for the model (customized).
-e - Create CRUD routes for the model.

If you include the -b flag, a base repository will be created in the app/Repositories directory. All repositories created using this command will extend the base repository, providing them with CRUD methods for easy data management.

####EXAMPLE
To create a new Post model with a migration, factory, seeder, controller, repository, filter and routes, run the following command:

- php artisan make:model Car -mfscbde

This will create the following files:

- app/Models/Post.php
- database/migrations/2023_05_12_000000_create_cars_table.php
- database/factories/CarFactory.php
- database/seeders/CarTableSeeder.php
- app/Http/Controllers/Api/CarController.php
- app/Repositories/CarRepository.php
- app/Filters/CarFilters.php

The CarController will be automatically populated with basic CRUD methods that make use of the PostRepository.
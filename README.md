#MOVIE APP


###APP INFO
Bear in mind that only admins have full access to all functionalities.
Credentials for admins can be found in UserSeeder. One of them is: sasa@sasa.ba  password
POSTMAN Collection is also available (Movie-App.postman_collection.json) in the root of the project.
The images are planned to be implemented for the use with movies, users and posts (work in progress)....
I also implemented commands to provide an idea of automation and accelaration of the development process. 
If you want to test it,follow the steps below after you set the project:

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
10) By using api/cars/filter, you will be able to search by "id" and "name". If you use "orderById" and pass 'desc' or 'asc', you will be able to order the records. If you add 'pagination' and e.g. 4, you will controll how many records you fetch from the database ie. 4. Remember, no additional actions are required to have all of the above functionalities.

For more details, read Custom Artisan Commands and Stubs below.



###MODELS
There are 6 models in the application: User, Role, Movie, Post, favoriteMovieUser and Image.
I was planning to implement image upload and conversion to base64, so that I can use them wth users, movies and posts.
However, the time was pretty limited and I only implemented Image model with filters, CRUD and tests. It was not a 
manual task but automatic (see setion custom commands below).



###SOFT DELETE
Soft delete was implemented in all models. This is a standard practice and an extra measure to prevent any unwanted data
loss.



###ROLES
There are 3 roles seeded in the application: admin, user and guest. Guest is more used as an example, so that it can be used in CRUD operations testing.



###EXCEPTIONS AND LOGS
The exception handling was done via SetLogMessagesAndHttpResponse class. In this class I set custom response and write
logs that can be found in storage folder. The files are entitled error.php and info.php. The purpose is to have detailed
logs about anything that happens in the application.



###REPOSITORY
The application communicates with the database via so-called data access layer i.e. repository. Each model has a controller and each controller extends a base controller that has an interface. The CRUD operations are done via base
repository, while the rest, model-specific operations are done in the model specific repositories.



###SEARCH FILTER
Taking into account scalability, maintenance and easiness of adding new filters to each model, I implemented a filter
model. It uses traits, base filter and it is based on Eloquent builder. The request commes to a controller and it is
then redirected to the Model where a scope method is used (via Trait) to add a builder instance. It then goes to the
base filter where it is looped through. The point is that the methods in ModelFilters are entitled exactly the same as
the input fields. Therefore, when the base filter loops through the request, the methods are searched for in the 
ModelFilter and if they are found the field and value are applied to it. The base filter also implements pagination.



###FORM REQUESTS
All inputs are validated in custom requests i.e. form requests. Instead of method ->all(), ->validate() is used, so that
only the validated inputs are used (security).



###MIDDLEWARE
There are 2 middlewares in the application, CORS and AUTH. As their name says, they are used for login, logout and registration and CORS.



###POLICIES
Although policies are not part of the requirement, I included them as a security measure. They are commented out and in
case you want to test them, just uncomment e.g. $this->authorize('create') in any controller. Only the admin is allowed
to perform all CRUD operations. Bear in mind that tests do not work with policies.



###TESTS
The tests have been written for all the models (not all methods). They can be started using the following command:
- "php artisan test" 
or if you want to start only a specific test, you can use: 
"php artisan test --filter UserControllerTest".
The tests will require an additional database. See config/database.php and add the necessary keys in the .env.



###CACHING
The caching is implemented with favorite movies. It is refreshed each time a movie is added or deleted from the list. In addition, caching is suited to each user 
i.e. the cache is not deleted for a user with ID 4 if a user with e.g. ID 6 adds or removes a movie from the list.



###SLUGS AND ROUTE MODEL BINDING
Slugs are implemented on Posts model, just as a demonstration of how slugs can be set and used instead of ID. In addition, route model binding is implemented in all "show" methods in all controllers.


###JWT
The JWT user authentication has been implemented and the APIs cannot be used if a user is not logged in.



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

If you include the -b flag, a base repository will be created in the app/Repositories directory. All repositories created using this command will extend a base repository, providing them with pre-built CRUD methods for easy data management.

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
<?php

namespace App\Constants;

class LogMessage {
    const INSTANCE_CREATED = 'An instance of the model has been created by the user.';
    const INSTANCE_NOT_CREATED = 'An instance of the model has not been created by the user.';
    const INSTANCE_NOT_CREATED_WITH_ERROR = 'An instance of the model has not been created by the user. Error: ';

    const INSTANCE_RETRIEVED = 'An instance of the model has been provided to the user.';
    const INSTANCE_NOT_RETRIEVED = 'An instance of the model has not been provided to the user.';
    const INSTANCE_NOT_RETRIEVED_WITH_ERROR = 'An instance of the model has not been provided to the user. Error: ';


    const INSTANCES_RETRIEVED = 'Instances of the model have been provided to the user.';
    const INSTANCES_NOT_RETRIEVED = 'Instances of the model have not been provided to the user.';
    const INSTANCES_NOT_RETRIEVED_WITH_ERROR = 'Instances of the model have not been provided to the user. Error: ';

    const INSTANCE_UPDATED = 'An instance of the model has been updated by the user.';
    const INSTANCE_NOT_UPDATED = 'An instance of the model has not been updated by the user.';
    const INSTANCE_NOT_UPDATED_WITH_ERROR = 'An instance of the model has not been updated by the user. Error: ';

    const INSTANCE_DELETED = 'An instance of the model has been deleted by the user.';
    const INSTANCE_NOT_DELETED = 'An instance of the model has not been deleted by the user.';
    const INSTANCE_NOT_DELETED_WITH_ERROR = 'An instance of the model has not been deleted by the user. Error: ';
    const INSTANCE_NOT_DELETED_FORBIDDEN_ACTION = 'Company and administrator can\'t be deleted because some handymen have ongoing cases.';
    const INSTANCE_NOT_DELETED_BY_USER_FORBIDDEN_ACTION = 'It is not allowed to delete this case.';
    const USER_REGISTERED = 'A user has been registered.';
    const USER_NOT_REGISTERED = 'A user has not been registered.';
    const USER_NOT_REGISTERED_WITH_ERROR = 'A user has not been registered. Error: ';

    const USER_LOGGED_IN = 'A user has logged in.';
    const USER_NOT_LOGGED_IN = 'A user has not logged in. Unauthorized access or wrong credentials.';
    const USER_NOT_LOGGED_IN_WITH_ERROR = 'A user has not logged in. Error: ';

    const USER_LOGGED_OUT = 'A user has logged out.';
    const USER_NOT_LOGGED_OUT = "A user has not been logged out. Unauthorized access or wrong credentials.";
    const USER_NOT_LOGGED_OUT_WITH_ERROR = 'A user has not logged out. Error: ';

    const NOT_ALLOWED_ACTION = 'You are not allowed to perform this cation.';

    const EMAIL_IS_TAKEN = 'The email has already been taken.';

    const MOVIE_NOT_SELECTED = 'You have to select a movie.';

    const MOVIE_ALREADY_ADDED_TO_FAVORITES = 'The movie has already been added to favorites.';

    const MOVIE_NOT_SELECTED_AND_LIKED = 'The movie has to be added to your favorites first and then you will be able to remove it from your favorite list.';

}
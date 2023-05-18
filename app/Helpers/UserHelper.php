<?php

namespace App\Helpers;

use Illuminate\Contracts\Auth\Authenticatable;

class UserHelper {


    public static function getLoggedUser(): ?Authenticatable
    {
        return auth()->user();
    }


    public static function getLoggedUserId(): int|null
    {
        return auth()->user()->id;
    }


    public static function getLoggedUserRoleId(): int|null
    {
        return auth()->user()->role_id;
    }
    
}
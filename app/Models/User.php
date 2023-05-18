<?php

namespace App\Models;

use App\Traits\Filters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, Filters;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'registered_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    
    public function role(): BelongsTo 
    {
        return $this->belongsTo(Role::class);
    }


    public function movies(): HasMany 
    {
        return $this->hasMany(Movie::class, 'added_by_id');
    }


    public function favoriteMovies(): BelongsToMany 
    {
        return $this->belongsToMany(Movie::class, 'favorite_movie_user')->whereNull('favorite_movie_user.deleted_at')->using(FavoriteMovieUser::class);
    }


    public function posts(): HasMany 
    {
        return $this->hasMany(Post::class, 'author_id');
    }

}

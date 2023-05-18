<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_movie_user', function (Blueprint $table) {            
            $table->primary(['user_id', 'movie_id']);
            $table->unsignedBigInteger('user_id')->nullable()->constrained('users');
            $table->unsignedBigInteger('movie_id')->nullable()->constrained('movies');            
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_movie_user');
    }
};

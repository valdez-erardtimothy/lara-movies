<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * activity 4: producer, film genre, ratings, roles migration script (including relationships)
 */
class Activity4 extends Migration
{

    private function createProducersTable() {
        Schema::create('producers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('producer_fullname', 128);
            $table->string('email', 64);
            $table->string('website', 64);
            
        });
    }

    private function createGenresTable(){
        Schema::create('genres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('genre', 64);
        });
    }
    
    private function createActorRolesTable() {
        Schema::create('actor_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role', 64);
        });
    }
    

    // ================================================================================
    // relationships

    private function addGenreFKColumn() {
        Schema::table('films', function($table) {
            $table->bigInteger('genre_id')->nullable()->unsigned();
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('set null');
        });
    }

    /** 
     * pivot table for film actors
     */
    private function createFilmActorsTable() {
        Schema::create('film_actors', function (Blueprint $table) {
            $table->foreignId('actor_id')->constrained('actors')->onDelete('restrict');
            $table->foreignId('film_id')->constrained('films')->onDelete('restrict');
            
            $table->bigInteger('role_id')->nullable()->unsigned();
            $table->foreign('role_id')->references('id')->on('actor_roles')->onDelete('set null');

            $table->primary(['actor_id', 'film_id']);
            $table->string('character', 64);
        });
    }

    private function createFilmProducersTable() {
        Schema::create('film_producers', function (Blueprint $table) {
            $table->foreignId('producer_id')->constrained('producers')->onDelete('restrict');
            $table->foreignId('film_id')->constrained('films')->onDelete('restrict');
        });
    }

    private function createFilmRatingsTable() { 
        Schema::create('film_ratings', function (Blueprint $table) {
            $table->foreignId('film_id')->constrained('films')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->smallInteger('rating')->default(3);
            $table->text('comment')->nullable()->default('');
            // TODO: user_id FK
        });
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // try a wipe first 
        $this->down();

        // create main tables 
        $this->createActorRolesTable();
        $this->createGenresTable();
        $this->createProducersTable();
        // create relationship tables
        $this->createFilmActorsTable();
        $this->createFilmProducersTable();
        $this->addGenreFKColumn();

        //TODO:user ratings
        $this->createFilmRatingsTable();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        // drop fks
        if (Schema::hasColumn('films', 'genre_id')) {
            //
            Schema::table('films', function (Blueprint $table) {
                $table->dropForeign('films_genre_id_foreign');
                $table->dropColumn('genre_id');
            });
        }

        //
        Schema::dropIfExists('film_producers');
        Schema::dropIfExists('film_actors');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('actor_roles');
        Schema::dropIfExists('producers');
        Schema::dropIfExists('film_ratings');

    }
}

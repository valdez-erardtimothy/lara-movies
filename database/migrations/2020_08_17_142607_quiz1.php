<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Quiz1 extends Migration
{

    private function createFilmsTable() {
        Schema::create('films', function($table) {
            $table->bigIncrements('id');
            $table->string('film_title', 100);
            $table->text('story')->nullable()->default('');
            $table->date('release_date');
            $table->integer('duration')->unsigned();
            $table->text('additional_info')->nullable()->default('text');
        });
    }

    private function createActorsTable() { 
        Schema::create('actors', function($table) {
            $table->bigIncrements('id');
            $table->string('actor_fullname', 128);
            $table->text('actor_notes')->nullable();
        });
    }

    // movie-actors will be added at activity4 migration script

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createFilmsTable();
        $this->createActorsTable();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // drop the tabless
        Schema::dropIfExists('actors');
        Schema::dropIfExists('films');
    }
}

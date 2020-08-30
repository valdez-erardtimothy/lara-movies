<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActorsFilmsSoftdeletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('films', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('actors', function (Blueprint $table) {
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
        //
        Schema::table('films', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('actors', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}

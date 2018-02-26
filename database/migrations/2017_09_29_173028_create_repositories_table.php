<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repositories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('repository_id')->unsigned()->index()->nullable();
            $table->foreign('repository_id')->references('id')->on('repositories');


            $table->boolean('published')->default(false);
            $table->boolean('shared')->default(false)->nullable();

            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('scientificName')->nullable();
            $table->string('specie')->nullable();
            $table->string('commonName')->nullable();
            $table->string('localName')->nullable();
            $table->string('location')->nullable();
            $table->integer('estimatedDensity')->nullable();
            $table->string('pathwaySpread')->nullable();
            $table->text('threats')->nullable();
            $table->text('economicImportance')->nullable();
            $table->integer('remarks')->nullable();
            $table->double('latitude')->nullable();
            $table->double('altitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();
        });
        Schema::create('repository_user', function (Blueprint $table){
            $table->integer('repository_id')->unsigned()->index();
            $table->foreign('repository_id')->references('id')->on('repositories')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repositories');
    }
}

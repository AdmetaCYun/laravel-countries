<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->integer('country_region_id')->unsigned();
            $table->string('iso_alpha_2', 3);
            $table->string('iso_alpha_3', 4);
            $table->smallInteger('iso_numeric')->nullable();
            $table->string('international_phone', 150)->nullable();
            $table->boolean('visible')->default(true);
            $table->timestamps();

            $table->unique(['country_region_id', 'iso_alpha_2']);
            $table->foreign('country_region_id')->references('id')->on('countries_regions')->onDelete('cascade');
        });

        Schema::create('country_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('locale')->index();

            $table->unique(['country_id', 'locale']);
            $table->unique(['slug', 'locale']);
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_translations');
        Schema::dropIfExists('countries');
    }
}

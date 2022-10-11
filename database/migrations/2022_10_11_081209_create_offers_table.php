<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->foreignId('model_id')->references('id')->on('models');
            $table->string('generation')->index()->nullable();
            $table->bigInteger('generation_id')->index()->nullable();
            $table->integer('year')->index();
            $table->integer('run')->index();

            $table->foreignId('color_id')->nullable()->references('id')->on('models');
            $table->foreignId('body_type_id')->nullable()->references('id')->on('body_types');

            $table->integer('engine_type')->index();
            $table->integer('transmission')->index();
            $table->integer('gear_type')->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}

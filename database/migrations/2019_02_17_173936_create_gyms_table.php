<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;

class CreateGymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gyms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('branch')->nullable();
            $table->string('street');
            $table->string('city');
            $table->string('logo')->nullable();
            $table->string('landmark')->nullable();
            $table->string('landline')->nullable();
            $table->string('mobile')->nullable();
            $table->string('website')->nullable();
            $table->decimal('long', 10, 7);
            $table->decimal('lat', 10, 7);
            $table->integer('status');
            $table->string('operating_hours')->nullable();
            $table->softDeletes();
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
        Storage::deleteDirectory('public/gym-logos');
        Schema::dropIfExists('gyms');
    }
}

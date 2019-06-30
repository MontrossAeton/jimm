<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('size');
            $table->integer('height');
            $table->integer('width');
            $table->string('url');
            $table->string('duration');
            $table->datetime('expiration_date')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('description')->nullable();
            $table->string('status');
            $table->string('attachment')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
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
        Storage::deleteDirectory('public/ad-attachments');
        Schema::dropIfExists('ads');
    }
}

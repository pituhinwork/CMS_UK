<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlstoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urlstores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('url')->unique();
            $table->integer('clicks')->nullable();
            $table->string('actions')->nullable();
            $table->string('description')->nullable();
            $table->string('text')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
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
        Schema::dropIfExists('urlstores');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone_number')->unique();
            $table->string('type')->nullable();
            $table->string('drivng_licence_validity');
            $table->timestamps();
            $table->softDeletes();
        });

    }
}

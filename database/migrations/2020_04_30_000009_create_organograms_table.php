<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganogramsTable extends Migration
{
    public function up()
    {
        Schema::create('organograms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('post_name');
            $table->timestamps();
            $table->softDeletes();
        });

    }
}

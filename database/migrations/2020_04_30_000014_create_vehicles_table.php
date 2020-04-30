<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model_name');
            $table->string('model_year')->nullable();
            $table->date('ragistration_date');
            $table->string('engine_capacity');
            $table->string('vehicle_serial')->unique();
            $table->string('ragistration_number')->unique();
            $table->date('fitness_vality')->nullable();
            $table->date('tax_token_validity')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVehiclesTable extends Migration
{
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->unsignedInteger('vehicle_type_id');
            $table->foreign('vehicle_type_id', 'vehicle_type_fk_1387833')->references('id')->on('vehicle_types');
        });

    }
}

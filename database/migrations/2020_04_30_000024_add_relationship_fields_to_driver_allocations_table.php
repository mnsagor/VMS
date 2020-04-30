<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDriverAllocationsTable extends Migration
{
    public function up()
    {
        Schema::table('driver_allocations', function (Blueprint $table) {
            $table->unsignedInteger('driver_id');
            $table->foreign('driver_id', 'driver_fk_1388054')->references('id')->on('drivers');
            $table->unsignedInteger('ragistration_number_id');
            $table->foreign('ragistration_number_id', 'ragistration_number_fk_1388055')->references('id')->on('vehicles');
        });

    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVehicleAllocationsTable extends Migration
{
    public function up()
    {
        Schema::table('vehicle_allocations', function (Blueprint $table) {
            $table->unsignedInteger('organogram_id');
            $table->foreign('organogram_id', 'organogram_fk_1395344')->references('id')->on('organograms');
            $table->unsignedInteger('division_id');
            $table->foreign('division_id', 'division_fk_1395345')->references('id')->on('divisions');
        });

    }
}

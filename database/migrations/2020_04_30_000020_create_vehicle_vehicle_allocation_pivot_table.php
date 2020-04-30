<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleVehicleAllocationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('vehicle_vehicle_allocation', function (Blueprint $table) {
            $table->unsignedInteger('vehicle_allocation_id');
            $table->foreign('vehicle_allocation_id', 'vehicle_allocation_id_fk_1395346')->references('id')->on('vehicle_allocations')->onDelete('cascade');
            $table->unsignedInteger('vehicle_id');
            $table->foreign('vehicle_id', 'vehicle_id_fk_1395346')->references('id')->on('vehicles')->onDelete('cascade');
        });

    }
}

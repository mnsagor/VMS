<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRequisitionRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('requisition_requests', function (Blueprint $table) {
            $table->unsignedInteger('vehicle_type_id');
            $table->foreign('vehicle_type_id', 'vehicle_type_fk_1387897')->references('id')->on('vehicle_types');
        });

    }
}

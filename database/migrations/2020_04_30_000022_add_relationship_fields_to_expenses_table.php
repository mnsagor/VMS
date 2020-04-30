<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToExpensesTable extends Migration
{
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->unsignedInteger('vehicle_id');
            $table->foreign('vehicle_id', 'vehicle_fk_1387913')->references('id')->on('vehicles');
            $table->unsignedInteger('expence_catogory_id');
            $table->foreign('expence_catogory_id', 'expence_catogory_fk_1395366')->references('id')->on('expense_types');
        });

    }
}

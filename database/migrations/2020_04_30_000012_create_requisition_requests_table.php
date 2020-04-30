<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('requisition_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('designation');
            $table->string('phone_number');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->longText('purpose')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}

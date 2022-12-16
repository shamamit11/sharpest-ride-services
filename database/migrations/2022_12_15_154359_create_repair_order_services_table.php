<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_order_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('repair_order_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('service_type_id')->nullable();
            $table->unsignedBigInteger('part_type_id')->nullable();
            $table->integer('qty')->nullable();
            $table->double('price')->nullable();
            $table->timestamps();
            $table->foreign('repair_order_id')->references('id')->on('repair_orders')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('service_id')->references('id')->on('services')->cascadeOnUpdate();
            $table->foreign('service_type_id')->references('id')->on('service_types')->cascadeOnUpdate();
            $table->foreign('part_type_id')->references('id')->on('part_types')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_order_services');
    }
};

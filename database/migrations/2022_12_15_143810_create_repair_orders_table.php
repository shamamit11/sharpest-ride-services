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
        Schema::create('repair_orders', function (Blueprint $table) {
            $table->id();
            $table->string('code', 255);
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('vehicle_make_id')->nullable();
            $table->unsignedBigInteger('vehicle_model_id')->nullable();
            $table->string('year')->nullable();
            $table->string('engine')->nullable();
            $table->unsignedBigInteger('vehicle_type_id')->nullable();
            $table->string('vin_no')->nullable();
            $table->string('odometer_reading')->nullable();
            $table->string('license_plate')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnUpdate();
            $table->foreign('vehicle_make_id')->references('id')->on('vehicle_makes')->cascadeOnUpdate();
            $table->foreign('vehicle_model_id')->references('id')->on('vehicle_models')->cascadeOnUpdate();
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->cascadeOnUpdate();
            $table->foreign('status_id')->references('id')->on('statuses')->cascadeOnUpdate();
            $table->foreign('staff_id')->references('id')->on('staffs')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_orders');
    }
};

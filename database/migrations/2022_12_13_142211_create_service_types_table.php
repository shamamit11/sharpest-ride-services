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
        Schema::create('service_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('vehicle_make_id')->nullable();
            $table->unsignedBigInteger('vehicle_model_id')->nullable();
            $table->string('name');
            $table->double('price')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('service_id')->references('id')->on('services')->cascadeOnUpdate();
            $table->foreign('vehicle_make_id')->references('id')->on('vehicle_makes')->cascadeOnUpdate();
            $table->foreign('vehicle_model_id')->references('id')->on('vehicle_models')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_types');
    }
};

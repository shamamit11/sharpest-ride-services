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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->date('added_date')->nullable();
            $table->unsignedBigInteger('vehicle_make_id')->nullable();
            $table->unsignedBigInteger('vehicle_model_id')->nullable();
            $table->unsignedBigInteger('vehicle_type_id')->nullable();
            $table->string('year')->nullable();
            $table->string('engine')->nullable();
            $table->string('vin_no', 255)->nullable();
            $table->string('stock_no', 255)->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->integer('pack_no')->nullable();
            $table->decimal('purchase_amount', $precision = 8, $scale = 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('sell_date')->nullable();
            $table->integer('customer_id')->nullable();
            $table->decimal('sell_amount', $precision = 8, $scale = 2)->nullable();
            $table->string('title_status', 255)->nullable();
            $table->unsignedBigInteger('finance_id')->nullable();
            $table->mediumText('description')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('vehicle_make_id')->references('id')->on('vehicle_makes')->cascadeOnUpdate();
            $table->foreign('vehicle_model_id')->references('id')->on('vehicle_models')->cascadeOnUpdate();
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->cascadeOnUpdate();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->cascadeOnUpdate();
            $table->foreign('staff_id')->references('id')->on('staffs')->cascadeOnUpdate();
            $table->foreign('finance_id')->references('id')->on('finances')->cascadeOnUpdate();
            $table->foreign('status_id')->references('id')->on('statuses')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
};

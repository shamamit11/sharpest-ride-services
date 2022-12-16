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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 255);
            $table->string('name', 255);
            $table->string('email', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('mobile', 255);
            $table->integer('orders')->nullable()->default(1);
            $table->string('source', 255)->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('customers');
    }
};

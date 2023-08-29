<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('store_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('store_id')->unsigned();
            $table->string('store_url')->unique();
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('state_id')->unsigned();
            $table->bigInteger('city_id')->nullable();
            $table->string('city_name')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('pincode')->nullable();
            $table->double('lat',20,10)->nullable();
            $table->double('lon',20,10)->nullable();
            $table->string('address');
            $table->string('gst_no_code',5);
            $table->bigInteger('business_state_id')->nullabe();
            $table->string('state_code',10)->nullable();
            $table->string('code',10)->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('store_id')->on('stores')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_details');
    }
};

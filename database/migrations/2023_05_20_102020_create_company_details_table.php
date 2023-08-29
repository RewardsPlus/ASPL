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
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('company_category_id')->nullable();
            $table->bigInteger('business_type_id')->unsigned();
            $table->string('company_name')->nullable();
            $table->timestamps();
            // $table->foreign('company_category_id')->on('company_categories')->references('id')->cascadeOnDelete();
            $table->foreign('business_type_id')->on('business_types')->references('id')->cascadeOnDelete();
            $table->foreign('company_id')->on('companies')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_details');
    }
};

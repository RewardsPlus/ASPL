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
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_type')->nullable();
            $table->bigInteger('emp_id');
            $table->string('emp_code');
            $table->string('adhar_number')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('photo')->nullable();
            $table->string('adhar_img')->nullable();
            $table->string('address_proof')->nullable();
            $table->string('pancard_img')->nullable();
            $table->string('other_img')->nullable();
            $table->string('address')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_details');
    }
};

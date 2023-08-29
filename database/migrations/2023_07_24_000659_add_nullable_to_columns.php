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
        Schema::table('q_r_codes', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->string('link_text')->nullable()->change();
            $table->text('link_url')->nullable()->change();
            $table->text('Whatsapp')->nullable()->change();
            $table->text('facebook')->nullable()->change();
            $table->text('youtube')->nullable()->change();
            $table->text('instagram')->nullable()->change();
            $table->text('linkedin')->nullable()->change();
            $table->text('logo')->nullable()->change();
            $table->text('link_logo')->nullable()->change();

            $table->text('qr_code_url')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('columns', function (Blueprint $table) {
            //
        });
    }
};

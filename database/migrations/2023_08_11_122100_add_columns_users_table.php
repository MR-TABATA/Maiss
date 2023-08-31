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
        Schema::table('users', function (Blueprint $table) {
            $table->collation = 'utf8mb4_general_ci';
            $table->character = 'utf8mb4';
            $table->string('family_name')->nullable(true)->change();
            $table->string('given_name')->nullable(true)->change();
            $table->string('room')->nullable(true)->change();
            $table->string('account')->nullable(true)->change();
            $table->string('email')->nullable(true)->change();
            $table->string('password')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->string('family_name')->nullable(false)->change();
           $table->string('given_name')->nullable(false)->change();
           $table->string('room')->nullable(false)->change();
           $table->string('account')->nullable(false)->change();
           $table->string('email')->nullable(false)->change();
           $table->string('password')->nullable(false)->change();
        });
    }
};

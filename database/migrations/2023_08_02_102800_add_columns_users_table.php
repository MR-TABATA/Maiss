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
            $table->string('family_name')->after('name');
            $table->string('given_name')->after('family_name');
            $table->string('account')->unique()->after('given_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->dropColumn('family_name');
           $table->dropColumn('given_name');
           $table->dropColumn('account');
        });
    }
};

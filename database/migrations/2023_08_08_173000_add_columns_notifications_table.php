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
        Schema::table('notifications', function (Blueprint $table) {
            $table->collation = 'utf8mb4_general_ci';
            $table->character = 'utf8mb4';
            $table->dropColumn('expired_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
           $table->datetime('expired_at')->after('content')->nullable()->comment('掲載期限日');
        });
    }
};

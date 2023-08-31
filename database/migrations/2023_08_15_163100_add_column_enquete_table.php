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
        Schema::table('enquetes', function (Blueprint $table) {
            $table->collation = 'utf8mb4_general_ci';
            $table->character = 'utf8mb4';
            $table->datetime('start_at')->after('detail')->default('1970-01-01 00:00:00')->comment('アンケート開始日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('enquetes', function (Blueprint $table) {
           $table->dropColumn('start_at');
        });
    }
};

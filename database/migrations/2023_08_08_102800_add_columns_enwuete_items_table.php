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
        Schema::table('enquete_items', function (Blueprint $table) {
            $table->collation = 'utf8mb4_general_ci';
            $table->character = 'utf8mb4';
            $table->integer('total')->after('option')->default(0)->comment('累計');
            $table->integer('sum')->after('total')->default(0)->comment('アンケート総数');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('enquete_items', function (Blueprint $table) {
           $table->dropColumn('total');
           $table->dropColumn('sum');
        });
    }
};

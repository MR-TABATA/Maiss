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
        Schema::table('schedules', function (Blueprint $table) {
            $table->collation = 'utf8mb4_general_ci';
            $table->character = 'utf8mb4';
            $table->unsignedBigInteger('notification_id')->after('id')->default('1')->comment('お知らせID');
            $table->unsignedBigInteger('enquete_id')->after('id')->default('1')->comment('アンケートID');

            $table->foreign('notification_id')->references('id')->on('notifications');
            $table->foreign('enquete_id')->references('id')->on('enquetes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
           $table->dropColumn('notification_id');
           $table->dropColumn('enquete_id');
        });
    }
};

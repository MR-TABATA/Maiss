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
        Schema::table('general_meetings', function (Blueprint $table) {
            $table->dropColumn('filename');
            $table->string('meeting_filename')->after('place')->nullable(true)->comment('総会資料ファイル名');
            $table->string('minutes_filename')->after('meeting_filename')->nullable(true)->comment('議事録ファイル名');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_filename');
        Schema::dropIfExists('minutes_filename');
    }
};

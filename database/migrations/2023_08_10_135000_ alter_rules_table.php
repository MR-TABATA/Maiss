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
        Schema::table('rules', function (Blueprint $table) {
            $table->collation = 'utf8mb4_general_ci';
            $table->character = 'utf8mb4';
            $table->integer('chapter')->nullable(true)->change();
            $table->string('chapter_str')->nullable(true)->change();
            $table->integer('section')->nullable(true)->change();
            $table->string('section_str')->nullable(true)->change();
            $table->integer('paragraph')->nullable(true)->change();
            $table->text('paragraph_text')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->string('chapter')->nullable(false)->change();
        $table->string('chapter_str')->nullable(false)->change();
        $table->string('section')->nullable(false)->change();
        $table->string('section_str')->nullable(false)->change();
        $table->string('paragraph')->nullable(false)->change();
        $table->string('paragraph_text')->nullable(false)->change();
    }
};

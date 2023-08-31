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
        Schema::create('rules', function (Blueprint $table) {
            $table->collation = 'utf8mb4_general_ci';
            $table->character = 'utf8mb4';
            $table->id();
            $table->integer('chapter')->comment('章');
            $table->string('chapter_str')->comment('章文');
            $table->integer('section')->comment('節');
            $table->string('section_str')->comment('節文');
            $table->integer('paragraph')->comment('条');
            $table->text('paragraph_text')->comment('条文');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};

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
        Schema::create('enquete_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enquete_id')->comment('質問ID');
            $table->string('option')->comment('選択肢');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('enquete_id')->references('id')->on('enquetes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquete_items');
    }
};

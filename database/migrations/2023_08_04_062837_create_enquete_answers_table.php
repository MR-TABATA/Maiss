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
        Schema::create('enquete_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->unsignedBigInteger('enquete_id')->comment('質問ID');
            $table->unsignedBigInteger('enquete_item_id')->comment('回答ID');
            $table->text('comment')->nullable()->comment('コメント・意見');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('enquete_id')->references('id')->on('enquetes');
            $table->foreign('enquete_item_id')->references('id')->on('enquete_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquete_answers');
    }
};

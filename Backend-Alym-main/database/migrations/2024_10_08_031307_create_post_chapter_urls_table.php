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
        Schema::create('post_chapter_urls', function (Blueprint $table) {
            $table->id();
            $table->foreignId("chapter_id");
            $table->foreign('chapter_id')->references('id')->on('post_chapters')->onDelete('cascade');
            $table->text("url");
            $table->boolean("downloaded")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_chapter_urls');
    }
};

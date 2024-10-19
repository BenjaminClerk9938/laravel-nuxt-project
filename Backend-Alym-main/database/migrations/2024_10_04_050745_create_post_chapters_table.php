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
        Schema::create('post_chapters', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId("post_id");
            $table->foreign("post_id")->references("id")->on("posts")->onDelete("cascade");
            $table->integer("number")->nullable();
            $table->string("source_url")->nullable();
            $table->boolean("downloaded")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_chapters');
    }
};

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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("slug");
            $table->string("title");
            $table->string("alt_titles")->nullable();
            $table->json("tags")->nullable();
            $table->longText("description")->nullable();
            $table->text("cover")->nullable();
            $table->double("rating")->nullable();
            $table->string("category")->nullable();
            $table->string("status")->nullable();
            $table->boolean("published")->default(true);
            $table->string("views")->nullable()->default(0);
            $table->string("visits")->nullable();
            $table->string("fake_url")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

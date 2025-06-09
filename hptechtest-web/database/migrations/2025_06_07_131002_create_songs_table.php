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
        Schema::create('songs', function (Blueprint $table) {
            $table->string('id', 4)->primary();
            $table->string('song_title');
            $table->string('genre', 50);
            $table->string('singer_id', 4);
            $table->bigInteger('spotify_streams')->default(0);
            $table->timestamps();
            
            $table->foreign('singer_id')->references('id')->on('singers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};

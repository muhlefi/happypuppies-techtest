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
       Schema::create('singers', function (Blueprint $table) {
            $table->string('id', 4)->primary();
            $table->string('singer_name');
            $table->char('gender', 1);
            $table->integer('awards_count')->default(0);
            $table->string('country', 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('singers');
    }
};

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
        Schema::create('filetables', function (Blueprint $table) {
            $table->id();
            $table->string('file-name');
            $table->string('file-path');
            $table->string('file-type');
            $table->string('file-size');
            $table->string('userName')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filetables');
    }
};

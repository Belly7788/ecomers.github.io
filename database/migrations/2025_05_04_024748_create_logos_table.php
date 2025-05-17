<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logos', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // Stores the path to the uploaded image
            $table->unsignedBigInteger('user_id')->nullable(); // Links to users table
            $table->tinyInteger('status')->default(1); // Status (1 = active, 0 = deleted)
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logos');
    }
};

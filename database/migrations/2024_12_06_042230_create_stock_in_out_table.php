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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ingredient_id'); // Foreign key to ingredients table
            $table->integer('stock_in')->default(0); // Stock in
            $table->integer('stock_out')->default(0); // Stock out
            $table->text('remarks')->nullable(); // Optional remarks
            $table->unsignedBigInteger('user_id')->nullable(); // Track user who made the entry
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};

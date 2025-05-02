<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Safely drop the entire measurements table
        Schema::dropIfExists('measurements');
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Re-create it if you ever need to roll back
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // …any other columns you originally had…
            $table->timestamps();
        });
    }
};

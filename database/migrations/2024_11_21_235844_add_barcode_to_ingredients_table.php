<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBarcodeToIngredientsTable extends Migration
{
    public function up()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->string('barcode')->nullable()->after('storage_location');
        });
    }

    public function down()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropColumn('barcode');
        });
    }
}

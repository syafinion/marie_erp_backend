<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToIngredientsTable extends Migration
{
    public function up()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            // Comment out or remove this line
            // $table->string('measurement')->nullable()->after('is_checked');

            // Adjust the 'after' positions accordingly
            $table->boolean('is_loose')->default(false)->after('is_checked');
            $table->boolean('is_carton')->default(false)->after('is_loose');
            $table->boolean('is_bag')->default(false)->after('is_carton');
            $table->string('package_weight')->nullable()->after('is_bag');
            $table->decimal('unit_price', 10, 2)->nullable()->after('package_weight');
            $table->string('storage_location')->nullable()->after('unit_price');
        });
    }

    public function down()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            // Remove 'measurement' from the dropColumn array
            $table->dropColumn([
                // 'measurement', // Remove this line
                'is_loose',
                'is_carton',
                'is_bag',
                'package_weight',
                'unit_price',
                'storage_location',
            ]);
        });
    }
}

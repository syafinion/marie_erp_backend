<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToStocksTable extends Migration
{
    public function up(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->integer('plan_to_buy')->default(0);
            $table->decimal('price_per_unit', 10, 2)->nullable();
            $table->integer('consumption')->nullable();
            $table->integer('closing_stock')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn(['plan_to_buy', 'price_per_unit', 'consumption', 'closing_stock']);
        });
    }
};

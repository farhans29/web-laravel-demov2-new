<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMInventoryTable extends Migration
{
    public function up()
    {
        Schema::create('m_inventory', function (Blueprint $table) {
            $table->string('id_inventory', 50)->primary();
            $table->string('category', 50)->nullable();
            $table->string('name', 50)->nullable();
            $table->decimal('qty', 18, 4)->nullable();
            $table->string('unit', 50)->nullable();
            $table->decimal('hpp', 18, 2)->nullable();
            $table->decimal('automargin', 18, 2)->nullable();
            $table->decimal('minsales', 18, 2)->nullable();
            $table->decimal('price_list', 18, 2)->nullable();
            $table->string('currency', 50)->nullable();
            $table->decimal('last_purch', 18, 2)->nullable();
            $table->string('aktif_y_n', 50)->nullable();
            $table->decimal('ws_price', 18, 2)->nullable();
            $table->string('category_2', 50)->nullable();
            $table->string('plu', 50)->nullable();
            $table->string('w_unit', 50)->nullable();
            $table->decimal('net_wight', 18, 2)->nullable();
            $table->unsignedBigInteger('id_supplier')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_inventory');
    }
};

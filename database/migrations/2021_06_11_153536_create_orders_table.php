<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('table')->nullable();
            $table->timestamps();
        });

        Schema::create('order_item', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained();
            $table->foreignId('item_id')->constrained('menu_items');
            $table->integer('amount');
            $table->string('notes')->nullable();

            $table->unique(['order_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item');
        Schema::dropIfExists('orders');
    }
}

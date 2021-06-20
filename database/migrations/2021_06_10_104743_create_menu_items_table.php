<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('number')->nullable();
            $table->char('number_addition', 3)->nullable();
            $table->foreignId('category_id')->nullable()->constrained('menu_categories');
            $table->double('price');
            $table->mediumText('description')->nullable();
            $table->tinyInteger('spiciness')->min(0)->max(3)->default(0);
            $table->timestamps();

            $table->unique(['number', 'number_addition']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_categories');
        Schema::dropIfExists('menu_items');
    }
}

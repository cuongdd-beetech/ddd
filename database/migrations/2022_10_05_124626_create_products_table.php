<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id', 11)->nullable(false);
            $table->string('sku', 11)->unique()->nullable(false);
            $table->string('name', 255)->nullable(false);
            $table->integer('stock')->nullable(false);
            $table->string('avatar')->nullable(false);
            $table->date('expired_at')->nullable(false);
            $table->integer('category_id')->nullable(false);
            $table->tinyInteger('flag_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};

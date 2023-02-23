<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 100)->unique()->nullable(true);
            $table->string('phone', 11)->unique();
            $table->date('birthday');
            $table->string('full_name',100);
            $table->string('password');
            $table->string('reset_password');
            $table->string('address',255);
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('commune_id');
            $table->integer('status');
            $table->boolean('flag_delete')->default(0);
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
        Schema::dropIfExists('customers');
    }
};

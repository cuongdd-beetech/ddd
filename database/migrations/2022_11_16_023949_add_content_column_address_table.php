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
        Schema::table('users', function (Blueprint $table) {
            $table->string('address',255)->after('password');
            $table->integer('province_id')->after('address');
            $table->integer('district_id')->after('province_id');
            $table->integer('commune')->after('district_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('province_id');
            $table->dropColumn('district_id');
            $table->integer('commune')->after('district_id');
        });
    }
};

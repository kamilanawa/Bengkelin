<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * INFO
     *
     * file ini digunakan untuk menambahkan kolom rating dan review pada tabel bookings
     */



    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {

            $table->integer('rating')->nullable(true);
            $table->longText('review')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {

            $table->dropColumn('rating');
            $table->dropColumn('review');
        });
    }
};

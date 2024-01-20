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
        Schema::create('bengkels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilik_id');
            $table->foreign('pemilik_id')->references('id')->on('pemilik_bengkels')->onDelete('cascade');
            $table->string('name', 100);
            $table->string('image');
            $table->text('description');
            $table->longText('alamat');
            $table->string('link_alamat');
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
        Schema::dropIfExists('bengkels');
    }
};

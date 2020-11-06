<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikel_kategori', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
            $table->foreignId('artikel_id')->references('id')->on('artikels')->onDelete('cascade');
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
        Schema::dropIfExists('artikel_kategori');
    }
}

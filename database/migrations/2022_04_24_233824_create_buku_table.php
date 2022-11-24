<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100)->unique();
            $table->string('slug', 100);
            $table->string('sampul', 150);
            $table->string('penulis', 60);
            $table->string('tahun_terbit', 30);
            $table->integer('dilihat');
            $table->foreignId('tempat_terbit_id');
            $table->foreignId('penerbit_id');
            $table->foreignId('kategori_id');
            $table->foreignId('rak_id');
            $table->integer('stok');
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
        Schema::dropIfExists('buku');
    }
}

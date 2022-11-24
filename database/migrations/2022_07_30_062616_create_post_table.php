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
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('sampul', 150);
            $table->string('judul', 60);
            $table->string('slug', 60)->unique();
            $table->text('konten');
            $table->text('kutipan');
            $table->foreignId('kategori_id');
            $table->foreignId('user_id');
            $table->integer('dilihat');
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
        Schema::dropIfExists('post');
    }
};

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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->integer('qty');

            // Buku
            $table->string('pengarang')->nullable();
            $table->string('penerbit')->nullable();
            $table->enum('asal', ['Hadiah', 'Beli', 'Lain-lain'])->nullable();
            $table->enum('jenis_buku', ['Sastra', 'RPL', 'Akutansi', 'Farmasi', 'Bacaan'])->nullable();
            $table->integer('qty_rusak')->default(0);

            // Elektronik
            $table->string('type')->nullable();
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
        Schema::dropIfExists('barangs');
    }
};

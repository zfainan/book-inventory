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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->integer('jumlah');
            $table->enum('jenis', ['Sastra', 'RPL', 'Akutansi', 'Farmasi', 'Bacaan']);
            $table->string('penerbit');
            $table->integer('harga');
            $table->enum('status', ['ACC', 'TOLAK', 'Proses'])->nullable();
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
        Schema::dropIfExists('pengajuan');
    }
};

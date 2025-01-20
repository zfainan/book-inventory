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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('kondisi', 45)->nullable();
            $table->string('keterangan', 45)->nullable();
            $table->integer('jumlah')->nullable();
            $table->date('tanggal_register');
            $table->string('kode_inventaris', 45);
            $table->integer('id_jenis');
            $table->integer('id_ruang');
            $table->integer('id_petugas');
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
        Schema::dropIfExists('inventaris');
    }
};

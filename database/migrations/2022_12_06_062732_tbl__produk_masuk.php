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
        Schema::create('ProdukMasuk', function (Blueprint $table) {
            $table->increments('id_produkMasuk');
            $table->string('kd_produk', 10);
            $table->string('kd_resep');
            $table->string('nip_karyawan');
            $table->integer('jumlah');
            $table->date('tgl_produksi');
            $table->date('tgl_expired');
            $table->integer('modal');
            $table->string('ket');
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
        Schema::dropIfExists('ProdukMasuk');
    }
};

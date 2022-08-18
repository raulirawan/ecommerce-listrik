<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('no_resi')->nullable();
            $table->string('kode_transaksi')->nullable();
            $table->string('jenis_transaksi')->nullable()->comment('KONSUMEN/SUPPLIER');
            $table->string('bukti_transfer')->nullable();
            $table->string('link_pembayaran')->nullable();
            $table->integer('total_harga')->nullable();
            $table->string('status')->nullable();

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
        Schema::dropIfExists('transaksi');
    }
}

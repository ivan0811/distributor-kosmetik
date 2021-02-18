<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('norek')->nullable()->default('null');
            $table->bigInteger('no_pesanan')->unsigned();            
            $table->bigInteger('jumlah_pembayaran');
            $table->enum('metode_pembayaran', ['CASH', 'TRANSFER']);
            $table->enum('status_pembayaran', ['LUNAS', 'BELUM LUNAS']);            
            $table->timestamps();

            $table->foreign('norek')
            ->references('norek')
            ->on('rekening')
            ->onDelete('set null');     
            
            $table->foreign('no_pesanan')
            ->references('no_pesanan')
            ->on('pesanan')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::dropIfExists('pembayaran');
    }
}

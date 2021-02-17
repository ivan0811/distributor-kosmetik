<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->bigIncrements('no_pesanan');            
            $table->bigInteger('toko_id')->unsigned();
            $table->bigInteger('sales_id')->unsigned();                        
            $table->integer('total_barang');                        
            $table->integer('total_harga');            
            $table->timestamps();

            $table->foreign('sales_id')
            ->references('id')
            ->on('sales')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}

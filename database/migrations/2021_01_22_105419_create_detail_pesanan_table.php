<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('no_order')->unsigned();
            $table->bigInteger('barang_id')->unsigned();            
            $table->integer('satuan');                        
            $table->integer('qty');
            $table->integer('total_harga');
            $table->timestamps();

            $table->foreign('no_order')
            ->references('no_order')
            ->on('pesanan')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('barang_id')
            ->references('id')
            ->on('barang')
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
        Schema::dropIfExists('detail_pesanan');
    }
}

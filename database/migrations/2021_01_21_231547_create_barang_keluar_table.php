<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('barang_id')->unsigned();
            $table->bigInteger('detail_pesanan_id')->unsigned()->nullable()->default(null);
            $table->integer('jumlah');
            $table->timestamps();

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
        Schema::dropIfExists('barang_keluar');
    }
}

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
            $table->bigInteger('no_pesanan')->unsigned();
            $table->bigInteger('barang_id')->unsigned();            
            $table->integer('satuan');                        
            $table->integer('qty');
            $table->integer('total_harga');
            $table->timestamps();

            $table->foreign('no_pesanan')
            ->references('no_pesanan')
            ->on('pesanan')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('barang_id')
            ->references('id')
            ->on('barang')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::table('barang_keluar', function (Blueprint $table) {
            $table->foreign('detail_pesanan_id')
            ->references('id')
            ->on('detail_pesanan')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_keluar', function (Blueprint $table) {
            $table->dropForeign('barang_keluar_detail_pesanan_id_foreign');
        });
        Schema::dropIfExists('detail_pesanan');
    }
}

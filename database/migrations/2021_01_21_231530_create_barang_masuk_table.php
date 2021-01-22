<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('barang_id')->unsigned();            
            $table->string('kode_pabrik');                        
            $table->date('tanggal');
            $table->integer('jumlah');            
            $table->timestamps();

            $table->foreign('barang_id')
            ->references('id')
            ->on('barang')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('kode_pabrik')
            ->references('kode_pabrik')
            ->on('pemasok')
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
        Schema::dropIfExists('barang_masuk');
    }
}

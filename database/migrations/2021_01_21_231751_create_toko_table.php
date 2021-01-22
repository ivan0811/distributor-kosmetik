<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toko', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('kabupaten');            
            $table->string('kecamatan');
            $table->string('no_hp');            
            $table->text('alamat');
            $table->timestamps();
        });

        Schema::table('pesanan', function (Blueprint $table) {
            $table->foreign('toko_id')
            ->references('id')
            ->on('toko')
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
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropForeign('pesanan_toko_id_foreign');
        });
        Schema::dropIfExists('toko');
    }
}

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
            $table->string('norek');
            $table->bigInteger('no_order')->unsigned();            
            $table->bigInteger('jumlah_pembayaran');
            $table->enum('status_pembayaran', ['CASH', 'TRANSFER']);
            $table->date('tanggal_pembayaran');
            $table->timestamps();

            $table->foreign('norek')
            ->references('norek')
            ->on('rekening')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::table('cicilan', function (Blueprint $table) {
            $table->foreign('pembayaran_id')
            ->references('id')
            ->on('pembayaran')
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
        Schema::table('cicilan', function (Blueprint $table) {
            $table->dropForeign('cicilan_pembayaran_id_foreign');
        });
        Schema::dropIfExists('pembayaran');
    }
}

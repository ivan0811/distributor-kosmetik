<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCicilanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cicilan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pembayaran_id')->unsigned();
            $table->integer('jumlah_cicilan');
            $table->enum('status_cicilan', ['lunas', 'belum_lunas']);                                                
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
        Schema::dropIfExists('cicilan');
    }
}

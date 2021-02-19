<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekening', function (Blueprint $table) {
            $table->string('norek')->unique()->primary();
            $table->string('kode_bank');
            $table->string('atas_nama');
            $table->timestamps();

            $table->foreign('kode_bank')
            ->references('kode_bank')
            ->on('bank')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::table('pemasok', function (Blueprint $table){
            $table->foreign('norek')->references('norek')->on('rekening')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemasok', function (Blueprint $table) {
            $table->dropForeign('pemasok_norek_foreign'); 
        });
        Schema::dropIfExists('rekening');
    }
}

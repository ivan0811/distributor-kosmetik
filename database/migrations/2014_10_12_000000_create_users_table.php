<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');        
            $table->bigInteger('role_id')->unsigned();    
            $table->string('name');
            $table->string('username');
            $table->string('foto')->nullable()->default(null);
            $table->string('no_hp');            
            $table->enum('jk', ['L', 'P'])->nullable()->default(null);
            $table->string('kabupaten');            
            $table->string('kecamatan');            
            $table->text('alamat');            
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');            
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ktp', function (Blueprint $table) {
            $table->string('nik', 16)->primary();
            $table->string('nama');
            $table->string('tempatlahir');
            $table->date('tanggallahir');
            $table->enum('jekel', ['0', '1'])->nullable();
            $table->string('alamat');
            $table->string('agama');
            $table->enum('status', ['0', '1'])->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('ktp');
    }
}

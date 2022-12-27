<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerdinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perdin', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kota_asal')->unsigned();
            $table->foreign('kota_asal')->references('id')->on('master_kota')->onDelete('cascade');
            $table->bigInteger('kota_tujuan')->unsigned();
            $table->foreign('kota_tujuan')->references('id')->on('master_kota')->onDelete('cascade');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->text('keterangan')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('approval_user_id')->unsigned()->nullable();
            $table->foreign('approval_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status',['approved','pending','rejected'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perdin');
    }
}
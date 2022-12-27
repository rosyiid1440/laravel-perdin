<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUangSakuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uang_saku', function (Blueprint $table) {
            $table->id();
            $table->integer('awal')->nullable();
            $table->integer('akhir')->nullable();
            $table->enum('provinsi',[0,1])->nullable();
            $table->enum('pulau',[0,1])->nullable();
            $table->enum('luar_negeri',[0,1])->nullable();
            $table->string('satuan')->nullable();
            $table->decimal('nominal',15,2)->nullable();
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
        Schema::dropIfExists('uang_saku');
    }
}
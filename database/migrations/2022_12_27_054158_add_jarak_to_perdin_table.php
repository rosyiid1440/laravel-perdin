<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJarakToPerdinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perdin', function (Blueprint $table) {
            $table->integer('jarak')->nullable();
            $table->string('satuan')->nullable();
            $table->decimal('nominal',15,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perdin', function (Blueprint $table) {
            //
        });
    }
}
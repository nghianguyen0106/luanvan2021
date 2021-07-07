<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTthinhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tthinh', function (Blueprint $table) {
            $table->char('ttHinh',50);
            $table->integer('ttMa');
            $table->engine="InnoDB";

            $table->foreign('ttMa')->references('ttMa')->on('tintuc')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tthinhs');
    }
}

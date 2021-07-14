<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonhangSerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donhang_ser', function (Blueprint $table) {
            $table->char('serMa',20);
            $table->integer('hdMa');
            $table->integer('spMa');
            $table->engine = "InnoDB";

            //Foreign key
            $table->foreign('spMa')->references('spMa')->on('sanpham')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('hdMa')->references('hdMa')->on('donhang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donhang_ser');
    }
}

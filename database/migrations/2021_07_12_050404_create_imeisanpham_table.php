<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImeisanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imeisanpham', function (Blueprint $table) {
            $table->integer('spMa');
            $table->char('imeiMa',20);
            $table->integer('imeiTinhtrang');
            $table->engine="InnoDB";

            $table->foreign('spMa')->references('spMa')->on('sanpham')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imeisanpham');
    }
}

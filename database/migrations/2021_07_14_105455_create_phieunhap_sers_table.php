<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieunhapSersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieunhap_sers', function (Blueprint $table) {
            $table->char('serMa',20);
            $table->integer('pnMa');
            $table->integer('spMa');
            $table->engine = "InnoDB";

            //Foreign key
            $table->foreign('spMa')->references('spMa')->on('sanpham')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pnMa')->references('pnMa')->on('phieunhap')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieunhap_sers');
    }
}

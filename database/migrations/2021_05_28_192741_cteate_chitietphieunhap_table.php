<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CteateChitietphieunhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietphieunhap', function (Blueprint $table) {
            $table->integer('pnMa');
            $table->integer('spMa');
            $table->integer('nccMa');
            $table->integer('ctpnSoluong');
            $table->integer('ctpnDongia');
            $table->integer('ctpnThanhtien');
            $table->engine = "InnoDB";
            
            //foreign key
            $table->foreign('pnMa')->references('pnMa')->on('phieunhap')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('spMa')->references('spMa')->on('sanpham')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('nccMa')->references('nccMa')->on('nhacungcap')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

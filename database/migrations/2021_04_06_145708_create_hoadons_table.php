<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoadonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoadon', function (Blueprint $table) {
            $table->integer('hdMa')->primary();
            $table->integer('khMa');
            $table->date('hdNgaytao');
            $table->integer('hdSoluongsp');
            $table->integer('hdTongtien');
            $table->integer('hdTinhtrang');
            $table->engine = "InnoDB";
            //foreign key
             $table->foreign('khMa')->references('khMa')->on('khachhang')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoadon');
    }
}

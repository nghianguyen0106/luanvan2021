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
        Schema::create('donhang', function (Blueprint $table) {
            $table->integer('hdMa')->primary();
            $table->integer('khMa');
            $table->date('hdNgaytao');
            $table->integer('hdSoluongsp');
            $table->integer('hdTongtien');
            $table->integer('hdTinhtrang');
            $table->string('hdDiachi');
            $table->char('hdSdtnguoinhan');
            $table->string('hdGhichu')->nullable(true);
            $table->unsignedInteger('adMa');
            $table->integer('adMa');
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

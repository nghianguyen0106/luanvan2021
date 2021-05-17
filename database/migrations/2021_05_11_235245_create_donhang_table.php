<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonhangTable extends Migration
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
            $table->timestamp('hdNgaytao');
            $table->integer('hdSoluongsp');
            $table->float('hdTongtien',20,4);
            $table->integer('hdTinhtrang');
            $table->string('hdDiachi');
            $table->char('hdSdtnguoinhan',11);
            $table->string('hdGhichu')->nullable(true);
            $table->integer('kmMa')->nullable(true);
            $table->integer('adMa');
            $table->engine = "InnoDB";
            
            //foreign key
             $table->foreign('khMa')->references('khMa')->on('khachhang')->onDelete('cascade')->onUpdate('cascade');
             $table->foreign('kmMa')->references('kmMa')->on('khuyenmai')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donhang');
    }
}

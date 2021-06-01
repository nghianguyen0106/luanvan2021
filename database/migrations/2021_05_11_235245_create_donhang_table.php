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
            $table->float('hdTongtien',20,2);
            $table->integer('hdTinhtrang');
            $table->char('hdSdtnguoinhan',11);
            $table->string('hdDiachi');
            $table->string('hdGhichu')->nullable(true);
            $table->char('vcMa')->nullable(true);
            $table->integer('adMa')->nullable(true);
            $table->engine = "InnoDB";
            
            //foreign key
             $table->foreign('khMa')->references('khMa')->on('khachhang')->onDelete('cascade')->onUpdate('cascade');
             
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

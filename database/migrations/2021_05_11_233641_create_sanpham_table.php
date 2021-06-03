<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->integer('spMa')->primary();
            $table->string('spTen')->unique();
            $table->float('spGia',20,4);
            $table->integer('spHanbh');
            $table->integer('spTinhtrang');
            $table->integer('thMa');
            $table->integer('loaiMa');
            $table->integer('ncMa');
            $table->integer('nccMa');
            $table->integer('kmMa')->nullable(true);
            $table->integer('spSlkmtoida')->nullable(true);
          
            $table->engine = "InnoDB";
            // foreign key
            $table->foreign('ncMa')->references('ncMa')->on('nhucau')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('loaiMa')->references('loaiMa')->on('loai')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('thMa')->references('thMa')->on('thuonghieu')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('sanpham');
    }
}

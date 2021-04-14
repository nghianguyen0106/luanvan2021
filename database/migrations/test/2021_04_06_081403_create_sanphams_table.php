<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanphamsTable extends Migration
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
            $table->string('spTen',50)->unique();
            $table->integer('spGia');
            $table->integer('spTinhtrang');
            $table->integer('spHanbh');
            $table->integer('kmMa');
            $table->integer('thMa');
            $table->integer('loaiMa');
            $table->integer('ncMa');
            $table->engine = "InnoDB";
            // foreign key
            $table->foreign('ncMa')->references('ncMa')->on('nhucau')->onDelete('cascade');
            $table->foreign('loaiMa')->references('loaiMa')->on('loai')->onDelete('cascade');
            $table->foreign('thMa')->references('thMa')->on('thuonghieu')->onDelete('cascade');
            $table->foreign('kmMa')->references('kmMa')->on('khuyenmai');

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

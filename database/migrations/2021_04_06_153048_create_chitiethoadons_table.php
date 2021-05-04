<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitiethoadonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietdonhang', function (Blueprint $table) {
            $table->integer('hdMa');
            $table->integer('spMa');
            $table->integer('cthdSoluong');
            $table->integer('cthdGia');
            $table->engine = "InnoDB";
            //foreign key
            $table->foreign('hdMa')->references('hdMa')->on('hoadon')->onDelete('cascade');
            $table->foreign('spMa')->references('spMa')->on('sanpham')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitiethoadon');
    }
}

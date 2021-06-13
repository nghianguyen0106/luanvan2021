<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher', function (Blueprint $table) {
            $table->char('vcMa')->primary();
            $table->string('vcTen')->unique();
            $table->integer('vcTinhtrang');
            $table->integer('vcSoluot');
            $table->integer('vcLoai');
            $table->timestamp('vcNgaybd');
            $table->timestamp('vcNgaykt');
            $table->integer('vcLoaigiamgia');
            $table->integer('vcMucgiam');
            $table->integer('vcGiatritoithieu')->nullable(true);
            $table->integer('spMa')->nullable(true);

            $table->engine = "InnoDB";

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
        Schema::dropIfExists('voucher');
    }
}

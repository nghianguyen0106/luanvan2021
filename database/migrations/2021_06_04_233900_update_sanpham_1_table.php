<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSanpham1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
             Schema::table('sanpham', function (Blueprint $table) {
            
            $table->foreign('loaiMa')->references('loaiMa')->on('loai')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('thMa')->references('thMa')->on('thuonghieu')->onDelete('cascade')->onUpdate('cascade');
           
        });    }

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

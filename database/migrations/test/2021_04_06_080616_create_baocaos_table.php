<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaocaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baocao', function (Blueprint $table) {
            $table->id('bcMa');
            $table->integer('bcTonghangxuat');
            $table->integer('bcTonghangnhap');
            $table->integer('bcThu');
            $table->integer('bcChi');
            $table->integer('bcTonkho');
            $table->string('bcGhichu');
            $table->date('bcNgaylap');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baocao');
    }
}

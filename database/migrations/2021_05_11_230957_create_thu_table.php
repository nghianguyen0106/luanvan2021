<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thu', function (Blueprint $table) {
            $table->integer('adMa');
            $table->timestamp('alNgaygio');
            $table->integer('thuSoluong');
            $table->float('thuTongtien',20,4);
            $table->string('thuNoidung');
            $table->engine = "InnoDB";
            
            $table->foreign('adMa')->references('adMa')->on('admin')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thu');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHinhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hinh', function (Blueprint $table) {
            $table->integer('spMa',50);
            $table->char('spHinh');
            $table->engine = "InnoDB";
            //foreign key
            
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
        Schema::dropIfExists('hinh');
    }
}

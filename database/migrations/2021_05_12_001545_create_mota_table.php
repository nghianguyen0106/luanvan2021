<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mota', function (Blueprint $table) {
            $table->integer('spMa');
            $table->string('ram');
            $table->string('cpu');
            $table->string('psu');
            $table->string('ocung');
            $table->string('vga')->nullable(true);
            $table->string('mainboard')->nullable(true);
            $table->string('manhinh')->nullable(true);
            $table->string('chuot')->nullable(true);
            $table->string('banphim')->nullable(true);
            $table->string('vocase')->nullable(true);
            $table->string('pin')->nullable(true);
            $table->string('tannhiet')->nullable(true);
            $table->string('loa')->nullable(true);
            $table->string('mau')->nullable(true);
            $table->string('trongluong')->nullable(true);
            $table->string('conggiaotiep')->nullable(true);
            $table->string('webcam')->nullable(true);
            $table->string('chuanlan')->nullable(true);
            $table->string('chuanwifi')->nullable(true);
            $table->string('hedieuhanh')->nullable(true);
            $table->engine = "InnoDB";
            // foreign key
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
        Schema::dropIfExists('mota');
    }
}

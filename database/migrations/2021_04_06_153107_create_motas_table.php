<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotasTable extends Migration
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
            $table->string('manhinh',50)->nullable(true);
            $table->string('chuot',50)->nullable(true);
            $table->string('banphim',50)->nullable(true);
            $table->string('ram',50);
            $table->string('psu',50);
            $table->string('mainboard',50);
            $table->string('ocung',50);
            $table->string('vga',50);
            $table->string('vocase',50)->nullable(true);
            $table->string('pin',50)->nullable(true);
            $table->string('tannhiet',50);
            $table->string('loa',50)->nullable(true);
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

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
            $table->string('manhinh')->nullable(true);
            $table->string('chuot')->nullable(true);
            $table->string('banphim')->nullable(true);
            $table->string('ram');
            $table->string('psu');
            $table->string('mainboard');
            $table->string('ocung');
            $table->string('vga');
            $table->string('vocase')->nullable(true);
            $table->string('pin')->nullable(true);
            $table->string('tannhiet');
            $table->string('loa')->nullable(true);
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

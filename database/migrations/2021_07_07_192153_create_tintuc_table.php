<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTintucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tintuc', function (Blueprint $table) {
            $table->integer('ttMa')->primary();
            $table->string('ttTieude',50);
            $table->longText('ttNoidung');
            $table->timestamp('ttNgaydang');
            $table->integer('ttTinhtrang');
            $table->integer('ttLuotxem')->default(0);
            $table->integer('adMa');
            $table->engine="InnoDB";

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
        Schema::dropIfExists('tintucs');
    }
}

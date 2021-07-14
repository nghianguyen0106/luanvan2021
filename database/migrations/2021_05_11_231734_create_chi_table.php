<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi', function (Blueprint $table) {
            $table->integer('adMa');
            $table->timestamp('chiNgaygiolap');
            $table->integer('chiSoluong');
            $table->float('chiTongtien',20,2);
            $table->text('chiNoidung');
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
        Schema::dropIfExists('chi');
    }
}

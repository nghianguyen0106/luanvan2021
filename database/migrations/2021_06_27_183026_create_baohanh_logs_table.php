<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaohanhLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baohanh_logs', function (Blueprint $table) {
            $table->char('serial',30);
            $table->timestamp('bhNgay');
            $table->integer('khMa');
            $table->engine = "InnoDB";
            $table->foreign('khMa')->references('khMa')->on('khachhang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baohanh_logs');
    }
}

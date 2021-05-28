<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhuyenmaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khuyenmai', function (Blueprint $table) {
            $table->integer('kmMa')->primary();
            $table->text('kmMota');
            $table->integer('kmTrigia');
            $table->timestamp('kmNgaybd');
            $table->timestamp('kmNgaykt');
            $table->integer('kmSoluong')->nullable(true);
            $table->integer('lkmMa');
            $table->engine = "InnoDB";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('khuyenmai');
    }
}

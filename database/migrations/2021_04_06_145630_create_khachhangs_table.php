<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhachhangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khachhang', function (Blueprint $table) {
            $table->integer('khMa');
            $table->primary('khMa');
            $table->string('khTen',50);
            $table->char('khEmail',50)->unique();
            $table->char('khMatkhau',50);
            $table->date('khNgaysinh');
            $table->string('khDiachi');
            $table->integer('khQuyen');
            $table->integer('khGioitinh');
            $table->char('khTaikhoan');
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
        Schema::dropIfExists('khachhang');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->integer('adMa')->primary();
            $table->string('adTen',50)->unique();
            $table->char('adTaikhoan',100)->unique();
            $table->char('adMatkhau',255);
            $table->char('adEmail',100)->unique();
            $table->char('adSdt',11)->unique();
            $table->integer('adQuyen');
            $table->char('adHinh',255);
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
        Schema::dropIfExists('admin');
    }
}

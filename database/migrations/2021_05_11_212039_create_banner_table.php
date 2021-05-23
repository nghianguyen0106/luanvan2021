<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->id('bnMa');
            $table->string('bnTieude');
            $table->char('bnHinh',255);
            $table->timestamp('bnNgay');
            $table->integer('bnVitri');
            $table->integer('kmMa')->nullable(true);
            $table->engine = "InnoDB";
            
            $table->foreign('kmMa')->references('kmMa')->on('khuyenmai')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imgs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prj_id'); // 使用者的外鍵
            $table->string('pic_name');
            $table->string('folder');
            $table->tinyInteger('type')->default(0);
            $table->boolean('master')->default(false);
            $table->timestamps();

            // 添加外鍵約束
            $table->foreign('prj_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imgs');
    }
};

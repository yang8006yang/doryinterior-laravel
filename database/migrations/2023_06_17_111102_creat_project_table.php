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
        //
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('type_id');
            $table->string('client',50);
            $table->string('location')->default('private');
            $table->integer('value')->default(0);
            $table->string('photoby')->nullable();
            $table->text('description')->nullable();
            $table->boolean('show')->default(false);
            $table->unsignedBigInteger('user_id'); // 使用者的外鍵
            $table->unsignedBigInteger('modby')->nullable();
            $table->timestamps();

            // 添加外鍵約束
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('modby')->references('id')->on('users');
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};

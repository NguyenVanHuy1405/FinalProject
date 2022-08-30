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
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('roomtype_id')->unsigned();
            $table->foreign('roomtype_id')->references('id')->on('room_types');
            $table->integer('kindofroom_id')->unsigned();
            $table->foreign('kindofroom_id')->references('id')->on('kind_of_rooms');
            $table->string('room_name',100);
            $table->string('room_description');
            $table->text('room_content');
            $table->string('room_price');
            $table->string('room_image');
            $table->integer('room_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};

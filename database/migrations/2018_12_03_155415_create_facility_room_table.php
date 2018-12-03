<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_room', function (Blueprint $table) {
            $table->unsignedInteger('room_id');
            $table->unsignedInteger('facility_id');

            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_room');
    }
}

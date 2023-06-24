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
        Schema::create('hostels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->string('thumbnail');
            $table->string('address_detail');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('ward_id');
            $table->integer('price');
            $table->string('payment_note');
            $table->integer('deposit_price');
            $table->integer('electricity_price');
            $table->integer('water_price');
            $table->string('water_note');
            $table->integer('internet_price');
            $table->string('internet_note');
            $table->string('acreage');
            $table->boolean('air_conditional');
            $table->boolean('heater');
            $table->boolean('washing_machine');
            $table->boolean('stay_with_host');

            $table->boolean('closed_room');
            $table->boolean('parking_area');
            $table->integer('floor');
            $table->boolean('elevator');
            $table->boolean('kitchen');
            $table->boolean('balcony');

            $table->integer('amount_of_people');
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
        Schema::dropIfExists('hostels');
    }
};

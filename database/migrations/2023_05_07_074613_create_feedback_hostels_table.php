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
        Schema::create('feedback_hostels', function (Blueprint $table) {
            $table->id();
            $table->integer('rate');
            $table->string('content');
            $table->unsignedBigInteger('hostel_id');
            $table->foreign('hostel_id')->references('id')->on('hostels')->onDelete('cascade');
            $table->unsignedBigInteger('from_user_id');
            $table->foreign('from_user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('feedback_hostels');
    }
};

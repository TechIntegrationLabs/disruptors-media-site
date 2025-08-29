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
        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->string('studio_title'); // Studio title as varchar
            $table->string('location'); // Location as varchar
            $table->longText('feature_image'); // Feature image as longtext
            $table->longText('about_content'); // About content as longtext
            $table->string('pricing_text'); // Pricing text as varchar
            $table->string('booking_action_link'); // Booking action link as varchar
            $table->string('message_us_link'); // Message us link as varchar
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studios');
    }
};

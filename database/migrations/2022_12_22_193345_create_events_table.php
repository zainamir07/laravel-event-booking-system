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
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('event_name');
            $table->date('event_start_date');
            $table->time('event_start_time');
            $table->date('event_end_date');
            $table->time('event_end_time');
            $table->string('event_location');
            $table->string('event_address');
            $table->string('event_slug');
            $table->string('event_author_id');
            $table->string('event_guestCapacity');
            $table->enum('event_subscription', ['P', 'F']);
            $table->string('event_ticket_price')->nullable();
            $table->boolean('event_status')->default(1);
            $table->longText('event_description');
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
        Schema::dropIfExists('events');
    }
};

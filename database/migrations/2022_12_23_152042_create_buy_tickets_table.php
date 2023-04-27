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
        Schema::create('buy_tickets', function (Blueprint $table) {
            $table->id('buy_ticket_id');
            $table->string('buyer_user_name');
            $table->string('buyer_user_email')->nullable();
            $table->string('buyer_user_contact')->nullable();
            $table->string('buyer_user_address')->nullable();
            $table->string('buyer_user_cnic');
            $table->string('buyer_user_payment_method');
            $table->enum('buyer_user_payment_status', ['P', 'UP']);
            $table->string('buyer_user_comment')->nullable();
            $table->string('buyer_user_ticket_price');
            $table->string('buyer_user_id');
            $table->string('buyer_event_id');
            $table->string('buyer_event_author_id');
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
        Schema::dropIfExists('buy_tickets');
    }
};

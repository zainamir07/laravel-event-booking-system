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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('noti_id');
            $table->string('noti_title');
            $table->enum('noti_for', ['U', 'OA', 'A']);
            $table->string('noti_forId')->nullable();
            $table->enum('noti_type', ['Reg', 'E', 'F', 'Rev', 'T' ]);
            // Reg (Registration), E (Event), F (Follow),  Rev (Review), T (Ticket)
            $table->string('noti_typeId')->nullable();
            $table->string('noti_byId');
            $table->boolean('noti_status')->default(0);
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
        Schema::dropIfExists('notifications');
    }
};

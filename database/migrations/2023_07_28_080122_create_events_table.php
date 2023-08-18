<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizer_id')->constrained('organizers')->onDelete('cascade');
            // Name is 100% required. If you don't know what event should be
            // called then don't create it.
            $table->string('event_name');
            // The meaning of event description and poster image can be null
            // is that sometime organizer don't know what to write or don't 
            // have any poster to upload yet. So it should allow to be null.
            $table->text('event_description')->nullable();
            $table->string('poster_image')->nullable();
            // location, start_date, end_date are null mean "To be announced"
            $table->string('location')->nullable();

            // Time period that allow user to register to this event
            $table->dateTime('register_start_date')->nullable();
            $table->dateTime('register_end_date')->nullable();

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            
            // If not published will not show to users
            $table->boolean('is_published')->default(false);
            
            // If false, user will not be able to register to this event. 
            // Which Can be use to promote an event only on our website.
            // [CONDITION] To enable this you need to set register start date and end date first
            $table->boolean('allow_register')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
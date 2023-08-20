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

            // For email
            $table->string('accepeted_email_subject')->nullable();
            $table->longText('accepeted_email_body')->nullable();
            
            $table->string('rejected_email_subject')->nullable();
            $table->longText('rejected_email_body')->nullable();
            
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

/* 
<p>Dear { user.name },</p>
<p>We are excited to inform you that your application for the { event.name } has been accepted! Congratulations on this accomplishment.</p>
<p>Event Details</p>
<ul>
    <li>Event Name: { event.name }</li>
    <li>Date: from { event.start_date } to { event.end_date }</li>
    <li>Location: { event.location }</li>
    <li>Link: <a href="{ event.link }"></a></li>
</ul>
<p>Your dedication and enthusiasm stood out to us during the selection process, and we believe that your participation will contribute greatly to the success of the event.</p>
<p>Thank you for choosing Beam as your partner in event organization. We're excited to embark on this journey together and create unforgettable experiences. Here's to a future filled with successful events and wonderful memories!</p>
<p>Best regards,</p>
<p>{ event.organizer_name }</p>
*/

/* 
<p>Dear { user.namme },</p>
<p>
    I trust this email finds you well. Thank you for taking the time to apply for participation in { event.name }. We appreciate your interest in being a part of this event.
</p>
<p>
    After careful consideration and a thorough review of all applications, we regret to inform you that your application for participation has not been selected on this occasion. We understand the dedication and effort you put into your application, and we want to assure you that this decision was not made lightly.
</p>

<p>
    Our selection process was highly competitive, and unfortunately, we had a limited number of spots available. Please know that your application stood out, and we were impressed by your abilities.
</p>

<p>
    We genuinely appreciate your interest in { event.name } and the enthusiasm you expressed in your application. We encourage you to continue pursuing your passion and goals, and we hope that you'll consider applying for future events organized by us.
</p>

<p>
    Thank you once again for considering { event.name }. We wish you all the best in your future endeavors and hope to cross paths in the future.
</p>

<p>Best regards,</p>
<p>{ event.organizer_name }</p>
*/
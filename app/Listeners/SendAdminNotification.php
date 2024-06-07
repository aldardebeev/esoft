<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;

class SendAdminNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Mail::raw("Note created: " . $event->note->title, function ($message) {
            $message->to('admin@example.com')
                ->subject('New Note Created');
        });
    }
}

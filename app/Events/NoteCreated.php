<?php

namespace App\Events;

use App\Modules\Note\Models\Note;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NoteCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Note $note;

    public function __construct(Note $note)
    {
        $this->note = $note;
    }
}

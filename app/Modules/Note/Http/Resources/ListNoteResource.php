<?php

namespace App\Modules\Note\Http\Resources;

use App\Common\Resources\DefaultResource;

class ListNoteResource extends DefaultResource
{
    protected function getItemResource(): DefaultResource
    {
        return NoteResource::make([]);
    }
}

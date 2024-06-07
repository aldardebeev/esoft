<?php

namespace App\Modules\Note\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Response\JResponse;
use App\Modules\Note\Exceptions\NotFoundException;
use App\Modules\Note\Http\Resources\NoteResource;
use App\Modules\Note\Services\NoteService;
use Illuminate\Http\JsonResponse;

class ShowNoteController extends Controller
{
    public function __construct(
        private readonly NoteService $noteService,
    )
    {
    }

    /**
     * @throws NotFoundException
     */
    public function __invoke(int $noteId): JsonResponse
    {

        return JResponse::ok(new NoteResource([
            'noteDTO' => $this->noteService->show($noteId)
        ]));
    }
}

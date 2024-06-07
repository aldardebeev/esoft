<?php

namespace App\Modules\Note\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Response\JResponse;
use App\Modules\Note\Exceptions\NotFoundException;
use App\Modules\Note\Http\Requests\CreateOrUpdateNoteRequest;
use App\Modules\Note\Services\NoteService;
use Illuminate\Http\JsonResponse;

class UpdateNoteController extends Controller
{
    public function __construct(
        private readonly NoteService $noteService,
    )
    {
    }

    /**
     * @throws NotFoundException
     */
    public function __invoke(CreateOrUpdateNoteRequest $request, int $noteId): JsonResponse
    {
        $this->noteService->update($request->toDto(), $noteId);

        return JResponse::ok();
    }
}

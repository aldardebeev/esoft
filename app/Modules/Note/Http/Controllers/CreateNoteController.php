<?php

namespace App\Modules\Note\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Response\JResponse;
use App\Modules\Note\Http\Requests\CreateOrUpdateNoteRequest;
use App\Modules\Note\Services\NoteService;
use Illuminate\Http\JsonResponse;

class CreateNoteController extends Controller
{
    public function __construct(
        private readonly NoteService $noteService,
    )
    {
    }

    /**
     */
    public function __invoke(CreateOrUpdateNoteRequest $request): JsonResponse
    {
        $this->noteService->create($request->toDto());

        return JResponse::ok();
    }
}

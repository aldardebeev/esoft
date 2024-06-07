<?php

namespace App\Modules\Note\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Response\JResponse;
use App\Modules\Note\Http\Requests\PaginateRequest;
use App\Modules\Note\Http\Resources\ListNoteResource;
use App\Modules\Note\Services\NoteService;
use Illuminate\Http\JsonResponse;

class ListNoteController extends Controller
{
    public function __construct(
        private readonly NoteService $noteService,
    )
    {
    }

    /**
     */
    public function __invoke(PaginateRequest $request): JsonResponse
    {
        return JResponse::ok(new ListNoteResource(
            $this->noteService->list($request->getPaginateDto())
        ));
    }
}

<?php

namespace App\Modules\Note\Repositories;

use App\Modules\Note\DTO\CreateOrUpdateNoteDTO;
use App\Modules\Note\DTO\PaginateDTO;
use App\Modules\Note\Models\Note;
use Illuminate\Pagination\LengthAwarePaginator;

interface NoteRepositoryInterface
{
    public function create(CreateOrUpdateNoteDTO $createNoteDTO, int $userId): Note;

    public function update(Note $note, CreateOrUpdateNoteDTO $createOrUpdateNoteDTO): void;
    public function getNoteList(int $userId, PaginateDTO $paginateDTO): LengthAwarePaginator;
    public function getNoteById(int $noteId): mixed;
}

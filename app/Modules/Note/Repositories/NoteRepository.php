<?php

namespace App\Modules\Note\Repositories;

use App\Modules\Note\DTO\CreateOrUpdateNoteDTO;
use App\Modules\Note\DTO\PaginateDTO;
use App\Modules\Note\Models\Note;
use App\Modules\User\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class NoteRepository implements NoteRepositoryInterface
{
    public function create(CreateOrUpdateNoteDTO $createNoteDTO, int $userId): Note
    {
        return Note::query()->create([
            'user_id' => $this->getAuthUser()->getId(),
            'title' => $createNoteDTO->getTitle(),
            'content' => $createNoteDTO->getContent(),
        ]);
    }

    public function update(Note $note, CreateOrUpdateNoteDTO $createOrUpdateNoteDTO): void
    {
       $note->update([
            'title' => $createOrUpdateNoteDTO->getTitle(),
            'content' => $createOrUpdateNoteDTO->getContent(),
        ]);
    }

    public function getNoteById(int $noteId): ?Note
    {
        return Note::query()
            ->where('id', '=', $noteId)
            ->first();
    }

    public function getNoteList(int $userId, PaginateDTO $paginateDTO): LengthAwarePaginator
    {
        return Note::query()
            ->where('user_id', '=', $userId)
            ->orderBy('id')
            ->paginate(perPage: $paginateDTO->getLimit(), page: $paginateDTO->getPage());
    }

    private function getAuthUser(): User
    {
        /** @var User */
        return Auth::user();
    }

}

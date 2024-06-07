<?php

namespace App\Modules\Note\Services;

use App\Events\NoteCreated;
use App\Modules\Note\DTO\CreateOrUpdateNoteDTO;
use App\Modules\Note\DTO\NoteDTO;
use App\Modules\Note\DTO\PaginateDTO;
use App\Modules\Note\Exceptions\NotFoundException;
use App\Modules\Note\Models\Note;
use App\Modules\Note\Repositories\NoteRepositoryInterface;
use App\Modules\User\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NoteService
{
    public function __construct(
        protected readonly NoteRepositoryInterface $noteRepository,
    )
    {
    }

    /**
     *  Создание записки
     * @param CreateOrUpdateNoteDTO $createNoteDTO
     */
    public function create(CreateOrUpdateNoteDTO $createNoteDTO): void
    {
        event(new NoteCreated(
            $this->noteRepository->create($createNoteDTO, $this->getAuthUser()->getId())
        ));
    }

    /**
     * @param CreateOrUpdateNoteDTO $createNoteDTO
     * @param int $noteId
     * @throws NotFoundException
     */
    public function update(CreateOrUpdateNoteDTO $createNoteDTO, int $noteId): void
    {
        $note = $this->noteRepository->getNoteById($noteId);

        $this->existNote($note);

        $this->noteRepository->update($note, $createNoteDTO);
    }

    /**
     * Просмотр записки по Id
     * @param int $noteId
     * @return NoteDTO
     * @throws NotFoundException
     */
    public function show(int $noteId): NoteDTO
    {
        $note = $this->noteRepository->getNoteById($noteId);

        $this->existNote($note);

        return new NoteDTO(
            id: $note->getId(),
            userId: $note->getUserId(),
            title: $note->getTitle(),
            content: $note->getContent(),
            created_at: $note->getCreatedAt(),
            updated_at: $note->getUpdatedAt(),
        );
    }

    public function list(PaginateDTO $paginateDTO): LengthAwarePaginator
    {
        return $this->noteRepository->getNoteList($this->getAuthUser()->getId(), $paginateDTO);
    }

    /**
     * Существует ли записка
     * @param ?Note $note
     * @throws NotFoundException
     */
    private function existNote(?Note $note): void
    {
        if (empty($note)) {
            throw new NotFoundException();
        }

        Gate::authorize('action-note', $note);
    }

    private function getAuthUser(): User
    {
        /** @var User */
        return Auth::user();
    }
}

<?php

namespace Tests\Unit;

use App\Events\NoteCreated;
use App\Modules\Note\DTO\CreateOrUpdateNoteDTO;
use App\Modules\Note\DTO\NoteDTO;
use App\Modules\Note\Repositories\NoteRepositoryInterface;
use App\Modules\Note\Services\NoteService;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Mockery;
use PHPUnit\Framework\TestCase;

class NoteServiceTest extends TestCase
{
    protected NoteRepositoryInterface $noteRepository;
    protected NoteService $noteService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->noteRepository = Mockery::mock(NoteRepositoryInterface::class);
        $this->noteService = new NoteService($this->noteRepository);
    }

    public function testCreateNote()
    {
        $user = User::query()->create([
            'email' => 'test@test.test',
            'password' => bcrypt('password'),
            'name' => 'Test Name',
            'email_verified_at' => now(),
        ]);

        $noteDTO = new NoteDTO(
            id: 1,
            userId: $user->id,
            title: 'Test Note',
            content: 'Test Content',
            created_at: now(),
            updated_at: now()
        );

        $createNoteDTO = new CreateOrUpdateNoteDTO('Test Note', 'Test Content');

        Auth::shouldReceive('user')->andReturn($user);

        $this->noteRepository
            ->shouldReceive('create')
            ->once()
            ->andReturn($noteDTO);

        $this->expectsEvents(NoteCreated::class);

        $this->noteService->create($createNoteDTO);
    }
}

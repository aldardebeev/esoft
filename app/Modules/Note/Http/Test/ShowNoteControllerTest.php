<?php

namespace App\Modules\Note\Http\Test;

use Tests\TestCase;
use Mockery;
use App\Modules\Note\Services\NoteService;
use App\Modules\Note\Http\Controllers\ShowNoteController;
use Illuminate\Http\JsonResponse;
use App\Modules\Note\Http\Resources\NoteResource;
use App\Modules\Note\DTO\NoteDTO;
use App\Modules\Note\Exceptions\NotFoundException;

class ShowNoteControllerTest extends TestCase
{
    public function testInvokeSuccess()
    {
        $noteId = 1;
        $noteDTO = new NoteDTO(
            id: $noteId,
            userId: 1,
            title: 'Test Note',
            content: 'This is a test note.',
            created_at: now(),
            updated_at: now()
        );

        $noteServiceMock = Mockery::mock(NoteService::class);
        $noteServiceMock->shouldReceive('show')->with($noteId)->andReturn($noteDTO);

        $controller = new ShowNoteController($noteServiceMock);

        $response = $controller->__invoke($noteId);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals((new NoteResource(['noteDTO' => $noteDTO]))->response()->getData(true), $response->getData(true));
    }

    public function testInvokeNotFound()
    {
        $this->expectException(NotFoundException::class);

        $noteId = 1;

        $noteServiceMock = Mockery::mock(NoteService::class);
        $noteServiceMock->shouldReceive('show')->with($noteId)->andThrow(new NotFoundException());

        $controller = new ShowNoteController($noteServiceMock);

        $controller->__invoke($noteId);
    }
}

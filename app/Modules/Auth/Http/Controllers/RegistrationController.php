<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Response\JResponse;
use App\Modules\Auth\Exceptions\EmailExistException;
use App\Modules\Auth\Http\Requests\LoginOrRegistrationRequest;
use App\Modules\Auth\Http\Resources\LoginOrRegistrationResource;
use App\Modules\Auth\Services\RegistrationService;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    public function __construct(
        private readonly RegistrationService $regService,
    )
    {
    }

    /**
     * @throws EmailExistException
     */
    public function __invoke(LoginOrRegistrationRequest $request): JsonResponse
    {
        return JResponse::ok(new LoginOrRegistrationResource([
            'token' => $this->regService->registration($request->toDto())->getToken()
        ]));
    }
}

<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Response\JResponse;
use App\Modules\Auth\Exceptions\InvalidPasswordException;
use App\Modules\Auth\Http\Requests\LoginOrRegistrationRequest;
use App\Modules\Auth\Http\Resources\LoginOrRegistrationResource;
use App\Modules\Auth\Services\LoginService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function __construct(
        private readonly LoginService $loginService,
    )
    {
    }


    /**
     * @throws InvalidPasswordException
     */
    public function __invoke(LoginOrRegistrationRequest $request): JsonResponse
    {
        return JResponse::ok(new LoginOrRegistrationResource([
            'token' => $this->loginService->login($request->toDto())->getToken()
        ]));
    }
}

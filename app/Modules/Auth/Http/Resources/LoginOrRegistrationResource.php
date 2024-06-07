<?php

namespace App\Modules\Auth\Http\Resources;

use App\Common\Resources\DefaultResource;
use Illuminate\Http\Request;

class LoginOrRegistrationResource extends DefaultResource
{
    public function toArray(Request $request): array
    {
        return [
            'access_token' => $this->toString($this->getPropertyOrNull('token')),
        ];
    }
}

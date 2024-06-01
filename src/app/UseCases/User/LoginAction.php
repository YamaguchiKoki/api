<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Data\Resources\User\UserResource;
use App\Data\User\CredentialData;
use App\UseCases\User\Exceptions\AuthenticationException;
use Illuminate\Support\Facades\Auth;

final class LoginAction
{
    public function __invoke(CredentialData $attributes): array
    {
        $token = Auth::guard('jwt')->attempt($attributes->toArray());

        if (! $token) {
            throw new AuthenticationException();
        }

        $user = Auth::guard('jwt')->user();

        return [UserResource::from($user), $token];
    }
}

<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Data\Resources\User\UserResource;
use \App\Data\Request\User\CredentialData;
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

        if (! $user) {
          throw new AuthenticationException('User not found');
        }

        // dd($user);

        return [UserResource::fromModel($user), $token];
    }
}

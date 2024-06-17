<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Data\Request\User\InitialData;
use App\Models\User;
use App\UseCases\User\Exceptions\DuplicateUserException;

final class CreateAction
{
    public function __invoke(InitialData $attributes): void
    {
        if (User::where('email', $attributes->email)->first() !== null) {
            throw new DuplicateUserException();
        }

        User::create([
            'email' => $attributes->email,
            'password' => $attributes->password,
            'screen_name' => $attributes->screenName,
        ]);
    }
}

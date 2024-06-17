<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Data\Request\User\CredentialData;
use App\Http\Requests\BaseRequest;

final class LoginRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'email' => 'required | email',
            'password' => 'required | string | min:8 | max:100',
        ];
    }

    public function getAttributes(): CredentialData
    {
        return CredentialData::from($this->validated());
    }
}

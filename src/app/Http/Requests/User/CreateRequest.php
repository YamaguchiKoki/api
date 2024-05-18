<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Data\User\CredentialData;
use App\Http\Requests\BaseRequest;

final class CreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
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

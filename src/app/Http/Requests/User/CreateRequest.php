<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Data\User\InitialData;
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
            'screen_name' => 'string',
            'email' => 'required | email',
            'password' => 'required | string | min:8 | max:100',
        ];
    }

    public function getAttributes(): InitialData
    {
        return InitialData::from($this->validated());
    }
}

<?php

namespace App\Http\Requests\User;

use App\Data\User\CredentialData;
use Illuminate\Foundation\Http\FormRequest;

use function PHPUnit\Framework\isTrue;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
      return true;
    }

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

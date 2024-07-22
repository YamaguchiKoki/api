<?php

namespace App\Http\Requests\User;

use App\Data\Request\User\UpdateProfileData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // 必要に応じて認可ロジックを実装
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'screen_name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'spotify' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'soundcloud' => ['nullable', 'url', 'max:255'],
            'applemusic' => ['nullable', 'url', 'max:255'],
            'linemusic' => ['nullable', 'url', 'max:255'],
            'bandcamp' => ['nullable', 'url', 'max:255'],
            'twitter' => ['nullable', 'url', 'max:255'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'screen_name' => 'ユーザー名',
            'bio' => 'プロフィール',
            'spotify' => 'Spotify URL',
            'youtube' => 'YouTube URL',
            'soundcloud' => 'SoundCloud URL',
            'applemusic' => 'Apple Music URL',
            'linemusic' => 'LINE MUSIC URL',
            'bandcamp' => 'Bandcamp URL',
            'twitter' => 'Twitter URL',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => ':attributeは必須です。',
            'string' => ':attributeは文字列で入力してください。',
            'max' => ':attributeは:max文字以内で入力してください。',
            'url' => ':attributeは有効なURLを入力してください。',
        ];
    }

    public function getAttributes(): UpdateProfileData
    {
        return UpdateProfileData::from($this->validated());
    }
}

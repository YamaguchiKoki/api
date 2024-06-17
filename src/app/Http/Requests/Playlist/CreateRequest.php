<?php

declare(strict_types=1);

namespace App\Http\Requests\Playlist;

use App\Data\Request\Playlist\ForStoreData;
use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Auth;

final class CreateRequest extends BaseRequest
{
    public function authorize(): bool
    {
      $user = Auth::guard('jwt')->user();
      return $user && $this->userId === $user->id;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules()
    {
        return [
            'userId' => 'required|uuid',
            'imageUrl' => 'nullable|url',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'songs' => 'required|array',
            'songs.*.name' => 'required|string|max:255',
            'songs.*.url' => 'required|url',
            'songs.*.type' => 'required|string|in:YouTube,Spotify,SoundCloud', // 必要に応じて追加
        ];
    }

    public function getAttributes(): ForStoreData
    {
        return ForStoreData::from($this->validated());
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'screen_name' => $this->when(! is_null($this->screenName), $this->screenName),
            'bio' => $this->when(! is_null($this->bio), $this->bio),
            'image_url' => $this->when(! is_null($this->imageUrl), $this->imageUrl),
            'token' => $this->token,
        ];
    }
}

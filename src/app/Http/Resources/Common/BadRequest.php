<?php

declare(strict_types=1);

namespace App\Http\Resources\Common;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

final class BadRequest extends JsonResource
{
    private string $message;

    /**
     * 配列の中に複数の型が入ることを想定してmixedを使用
     * @var array<string|int, mixed>|null
     */
    private ?array $info;

    /**
     * @param array<string|int, mixed>|null $info
     */
    public function __construct(string $message = 'bad request', ?array $info = null)
    {
        $this->message = $message;
        $this->info = $info;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => $this->message,
            'info' => $this->info,
        ];
    }

    /**
     * レスポンスのステータスコードを指定
     */
    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setStatusCode(Response::HTTP_BAD_REQUEST);
    }
}

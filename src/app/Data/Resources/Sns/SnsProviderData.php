<?php
namespace App\Data\Resources\Sns;

use App\Enums\SnsProviderType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;

class SnsProviderData extends Data
{
    #[MapOutputName(SnakeCaseMapper::class)]
    #[MapInputName(SnakeCaseMapper::class)]
    public function __construct(
        public int $id,
        public SnsProviderType $providerName,
    ) {}
}

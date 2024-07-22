<?php
namespace App\Data\Resources\Sns;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class UserSnsLinkData extends Data
{
    public function __construct(
        public int $id,
        public string $url,
        public SnsProviderData $snsProvider,
    ) {}

    public static function collection(mixed $items): DataCollection
    {
        return new DataCollection(static::class, $items);
    }
}

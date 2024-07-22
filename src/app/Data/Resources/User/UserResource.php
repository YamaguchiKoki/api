<?php

declare(strict_types=1);

namespace App\Data\Resources\User;

use App\Data\Resources\Sns\SnsProviderData;
use App\Data\Resources\Sns\UserSnsLinkData;
use App\Models\User;
use App\Models\UserSnsLink;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

/** @typescript */
final class UserResource extends Data
{
    #[MapOutputName(SnakeCaseMapper::class)]
    #[MapInputName(SnakeCaseMapper::class)]
    public function __construct(
        public string $id,
        public ?string $screenName,
        public ?string $bio,
        public ?string $imageUrl,
        #[DataCollectionOf(UserSnsLinkData::class)]
        public ?DataCollection $snsLinks,
    ) {
    }

    public static function fromModel(User $user): self
    {
        return new self(
            id: $user->id,
            screenName: $user->screen_name,
            imageUrl: $user->image_url,
            bio: $user->bio,
            snsLinks: UserSnsLinkData::collection($user->snsLinks->map(function (UserSnsLink $link) {
                return new UserSnsLinkData(
                    id: $link->id,
                    url: $link->url,
                    snsProvider: new SnsProviderData(
                        id: $link->provider->id,
                        providerName: $link->provider->provider_name,
                    )
                );
            }))
        );
    }
}

<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Data\Request\User\UpdateProfileData;
use App\Enums\SnsProviderType;
use App\Models\SnsProvider;
use App\Models\User;
use App\UseCases\User\Exceptions\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

final class UpdateAction
{
  public function __invoke(UpdateProfileData $userData): void
  {
      $user = Auth::guard('jwt')->user();

      if (! $user) {
          throw new AuthenticationException('User not found');
      }

      if ($user instanceof User) {
          $user->update([
              'screen_name' => $userData->screen_name,
              'bio' => $userData->bio,
          ]);

          // 既存のリンクを全て削除
          $user->snsLinks()->delete();

          /**
           * @var array<string, SnsProvider>
           */
          $snsProviders = SnsProvider::whereIn('provider_name', array_column(SnsProviderType::cases(), 'value'))->get()->keyBy(function (SnsProvider $item) {
            // provider_nameカラムはEnumにキャストされるため、ここで文字列に変換
            return $item->provider_name->value;
          });

          $snsLinks = [
              SnsProviderType::SPOTIFY->value => $userData->spotify,
              SnsProviderType::YOUTUBE->value => $userData->youtube,
              SnsProviderType::SOUNDCLOUD->value => $userData->soundcloud,
              SnsProviderType::APPLEMUSIC->value => $userData->applemusic,
              SnsProviderType::LINEMUSIC->value => $userData->linemusic,
              SnsProviderType::BANDCAMP->value => $userData->bandcamp,
              SnsProviderType::TWITTER->value => $userData->twitter,
          ];

          foreach ($snsLinks as $platform => $link) {
              if (!empty($link) && isset($snsProviders[$platform])) {
                  $user->snsLinks()->create([
                      'provider_id' => $snsProviders[$platform]->id,
                      'url' => $link,
                  ]);
              }
          }
      }
  }
}

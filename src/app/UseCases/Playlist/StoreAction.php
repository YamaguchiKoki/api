<?php

declare(strict_types=1);

namespace App\UseCases\Playlist;

use App\Data\Request\Playlist\ForStoreData;
use App\Data\Resources\Song\SongResource;
use App\Data\User\InitialData;
use App\Models\User;
use App\Models\Playlist;
use App\UseCases\User\Exceptions\DuplicateUserException;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Optional;

final class StoreAction
{
    /**
     * Undocumented function
     *
     * @param ForStoreData $attributes
     * @return array [Playlist, Song[]]
     */
    public function __invoke(ForStoreData $attributes): array
    {
      DB::beginTransaction();
      try {
        //登録処理
        $author = User::findOrFail($attributes->userId);

        $playlist = $author->playlists()->create([
          'name' => $attributes->title,
          'description' => $attributes->description,
          'image_url' => $attributes->imageUrl instanceof Optional ? null : $attributes->imageUrl
        ]);

        $songs = [];

        foreach ($attributes->songs as $order=>$songData) {
          $playlist->songs()->create([
              'name' => $songData->name,
              'order' => $order + 1,
              'url' => $songData->url,
              'url_type' => $songData->type
          ]);
          $song = $playlist->songs()->create([
            'name' => $songData->name,
            'order' => $order + 1,
            'url' => $songData->url,
            'url_type' => $songData->type
          ]);
          $songs[] = SongResource::from($song);
        }
        DB::commit();
        return [$playlist, $songs];
      } catch(Exception $e) {
        DB::rollBack();
        throw $e;
      }
    }
}

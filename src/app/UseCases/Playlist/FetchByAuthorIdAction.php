<?php

declare(strict_types=1);

namespace App\UseCases\Playlist;

use App\Data\User\InitialData;
use App\Models\User;
use App\Models\Playlist;
use App\UseCases\User\Exceptions\DuplicateUserException;
use Illuminate\Database\Eloquent\Collection;

final class FetchByAuthorIdAction
{
  /**
   * Undocumented function
   *
   * @param string $authorId
   * @return Collection<Playlist>
   */
    public function __invoke(string $authorId): Collection
    {
      $author = User::findOrFail($authorId);
      return $author->playlists;
    }
}

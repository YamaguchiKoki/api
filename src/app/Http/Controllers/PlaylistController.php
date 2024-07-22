<?php

namespace App\Http\Controllers;

use App\Data\Resources\PlayList\PlayListForListCollection;
use App\Data\Resources\PlayList\PlayListResource;
use App\Http\Requests\Playlist\CreateRequest;
use App\UseCases\Playlist\FetchByAuthorIdAction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Playlist;
use App\Data\Request\Playlist\ForStoreData;
use App\UseCases\Playlist\StoreAction;
use Exception;
use Spatie\LaravelData\Optional;

class PlaylistController extends Controller
{
  /**
   * 任意のユーザーが作成したプレイリストを全部取得
   *
   * @param Request $request
   * @param FetchByAuthorIdAction $fetchByAuthorId
   * @return PlayListForListCollection
   */
  public function index(Request $request, FetchByAuthorIdAction $fetchByAuthorId): PlayListForListCollection
  {
    $authorId = $request->query('author_id');
    try {
      /**
       * @var Collection<Playlist> $playlists
       */
      $playlists = $fetchByAuthorId($authorId);
    } catch(Exception $e) {
      return response()->error($e->getCode(), $e->getMessage());
    }
    return PlayListForListCollection::from([
      'playlists' => $playlists
    ]);
  }

  public function show(Request $request): PlayListResource
  {
    $playlistId = $request->query('playlist_id');
    $playlist = Playlist::findOrFail($playlistId);

    return PlayListResource::from($playlist->load(['songs']));
  }

  public function store(CreateRequest $request, StoreAction $store): PlayListResource
  {
    /**
     * @var ForStoreData $attributes
     */
    $attributes = $request->getAttributes();

    try {
      [$playlist, $songs] = $store($attributes);

      return PlayListResource::from([
        'id' => $playlist->id,
        'name' => $playlist->name,
        'description' => $playlist->description,
        'image_url' => $playlist->image_url ? $playlist->image_url: null,
        'added_to_bookshelf_count' => $playlist->added_to_bookshelf_count ?? 0,
        'songs' => $songs,
        'created_at' => $playlist->created_at,
      ]);
    } catch(Exception $e) {
      return response()->error($e->getCode(), $e->getMessage());
    }
  }

  public function delete()
  {
    //実装
  }
}

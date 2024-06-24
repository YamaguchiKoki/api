<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Playlist;

class LikeController extends Controller
{
    public function likePlaylist(Request $request, $playlistId)
    {
        $playlist = Playlist::findOrFail($playlistId);
        $user = $request->user();

        if ($user->likedPlaylists()->where('playlist_id', $playlistId)->exists()) {
            return response()->json(['message' => 'You have already liked this playlist'], 400);
        }

        $like = new Like();
        $like->user_id = $user->id;
        $like->playlist_id = $playlistId;
        $like->save();

        return response()->json(['message' => 'Playlist liked successfully'], 200);
    }

    public function unlikePlaylist(Request $request, $playlistId)
    {
        $playlist = Playlist::findOrFail($playlistId);
        $user = $request->user();

        $like = $user->likes()->where('playlist_id', $playlistId)->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Playlist unliked successfully'], 200);
        }

        return response()->json(['message' => 'You have not liked this playlist'], 400);
    }
}

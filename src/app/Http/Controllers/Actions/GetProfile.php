<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GetProfile extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
      Log::debug(print_r('kokikoi', true));
      $userId = $request->query('user_id');
      if (!$userId) {
        return response()->json(['message' => '該当するユーザーが存在しませんでした'], 404);
      }
      $user = User::with(['playlists.songs', 'likes', 'followers', 'snsLinks.provider'])->find($userId);
      Log::debug(print_r($user, true));
      return response()->json($user);
    }
}

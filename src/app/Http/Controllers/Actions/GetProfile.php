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
    public function __invoke(Request $request, User $user)
    {
      $user = User::with(['playlists.songs', 'likes', 'followers'])->find($user->id);
      Log::debug(print_r($user, true));
      return response()->json($user);
    }
}

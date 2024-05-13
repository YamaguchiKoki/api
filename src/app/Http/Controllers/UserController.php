<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateRequest;
use App\Jobs\SendVerificationEmail;
use App\Models\User;
use App\UseCases\User\RegisterByCredentialsAction;
use App\UseCases\User\Exceptions\DuplicateUserException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

final class UserController extends Controller
{
  public function create(CreateRequest $request, RegisterByCredentialsAction $action): JsonResponse
  {
    $attributes = $request->getAttributes();

    try {
      $action($attributes);
    } catch(DuplicateUserException $e) {
      return response()->json(['error' => $e->getMessage()], $e->getCode());
    }

    return new JsonResponse(['success' => true, 'message' => '登録されたメールアドレス宛に認証コードを送信しました'],
      201
    );
  }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\Resources\User\UserWithTokenResource;
use App\Data\User\CredentialData;
use App\Data\User\InitialData;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\UserResource;
use App\UseCases\User\CreateAction;
use App\UseCases\User\Exceptions\AuthenticationException;
use App\UseCases\User\Exceptions\DuplicateUserException;
use App\UseCases\User\LoginAction;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class UserController extends Controller
{
    //500errorの共通処理かく

    // TODO screen_nameも登録　一旦メール無しに
    /**
     * ユーザー新規登録
     *
     * email, passwordを受けDBにユーザー情報を仮登録
     * その後OTPをメールで送信する
     */
    public function create(CreateRequest $request, CreateAction $create): JsonResponse
    {
        /**
         * @var InitialData $attributes
         */
        $attributes = $request->getAttributes();

        try {
            $create($attributes);
        } catch (DuplicateUserException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'message' => 'ユーザー登録に成功しました'], 201);
    }

    public function login(LoginRequest $request, LoginAction $login): UserWithTokenResource
    {
        /**
         * @var CredentialData $attributes
         */
        $attributes = $request->getAttributes();

        try {
            /**
             * @var UserResource $user
             * @var string $token
             */
            [$user, $token] = $login($attributes);

            return UserWithTokenResource::from([
                'user' => $user,
                'token' => $token,
            ]);
        } catch (AuthenticationException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function logout()
    {
        Auth::logout();

        return response()->noContent();
    }
}

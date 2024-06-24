<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\Resources\User\UserWithTokenResource;
use App\Data\Request\User\CredentialData;
use App\Data\Request\User\InitialData;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\UserResource;
use App\UseCases\User\CreateAction;
use App\UseCases\User\LoginAction;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

final class UserController extends Controller
{
    //500errorの共通処理かく
    //基本的にはカスタム例外クラスに、ステータスコード、メッセージを詰めてあるので、レスポンスマクロに登録したerrorレスポンスにメッセージとコードを渡す
    //特定の例外のみerrorマクロに収まらない処理を行いたい場合のみcatchブロックを追加

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
        } catch (Exception $e) {
            return response()->error($e->getCode(), $e->getMessage());
        }
        return response()->json(['success' => true, 'message' => 'ユーザー登録に成功しました'], Response::HTTP_CREATED);
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
        } catch (Exception $e) {
          return response()->error($e->getCode(), $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();

        return response()->noContent();
    }
}

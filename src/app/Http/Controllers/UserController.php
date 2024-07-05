<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\Resources\User\UserWithTokenResource;
use App\Data\Request\User\CredentialData;
use App\Data\Request\User\InitialData;
use App\Data\Request\User\UpdateProfileData;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\LoginRequest;
use App\Data\Resources\User\UserResource;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\UseCases\User\CreateAction;
use App\UseCases\User\LoginAction;
use App\UseCases\User\UpdateAction;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class UserController extends Controller
{
    //基本的にはカスタム例外クラスに、ステータスコード、メッセージを詰めてあるので、レスポンスマクロに登録したerrorレスポンスにメッセージとコードを渡す
    //特定の例外に関してerrorマクロに収まらない処理を行いたい場合のみcatchブロックを追加

    /**
     * ユーザー新規登録
     *
     * @param CreateRequest $request
     * @param CreateAction $create
     * @return JsonResponse
     */
    public function create(CreateRequest $request, CreateAction $create): JsonResponse
    {
        /**
         * @var InitialData $attributes
         */
        $userData = $request->getAttributes();

        try {
            $create($userData);
        } catch (Exception $e) {
            Log::error(print_r($e->getMessage(), true));
            return response()->error($e->getCode(), $e->getMessage());
        }
        return response()->success(Response::HTTP_CREATED, 'ユーザー登録に成功しました');
    }

    /**
     * ユーザーログイン
     *
     * @param LoginRequest $request
     * @param LoginAction $login
     * @return UserWithTokenResource | JsonResponse
     */
    public function login(LoginRequest $request, LoginAction $login): UserWithTokenResource | JsonResponse
    {
        /**
         * @var CredentialData $attributes
         */
        $credentials = $request->getAttributes();

        try {
            /**
             * @var UserResource $user
             * @var string $token
             */
            [$user, $token] = $login($credentials);

            return UserWithTokenResource::from([
                'user' => $user,
                'token' => $token,
            ]);
        } catch (Exception $e) {
          Log::error(print_r($e->getMessage(), true));
          return response()->error($e->getCode(), $e->getMessage());
        }
    }

    /**
     * ユーザーログアウト
     *
     * @return void
     */
    public function logout()
    {
        Auth::logout();

        return response()->noContent();
    }

    /**
     * ユーザー更新
     *
     * @param UpdateRequest $request
     * @param UpdateAction $update
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, UpdateAction $update): JsonResponse
    {
      /**
       * @var UpdateProfileData $userData
       */
      $userData = $request->getAttributes();
      try {
        DB::beginTransaction();
        $update($userData);
        DB::commit();
      } catch(Exception $e) {
        DB::rollBack();
        Log::error(print_r($e->getMessage(), true));
        return response()->error($e->getCode(), $e->getMessage());
      }
      return response()->success(Response::HTTP_OK, 'ユーザー更新が完了しました');
    }

    public function show(Request $request)
    {
      $authUser = Auth::guard('jwt')->user();

      if ($authUser instanceof User) {
          $authUser->load(['snsLinks.provider']);
          return UserResource::fromModel($authUser);
      }

      return response()->json(['ok' => false]);
    }
}

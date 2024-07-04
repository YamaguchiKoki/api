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
use App\Enums\SnsProviderType;
use App\Http\Requests\User\UpdateRequest;
use App\Models\SnsProvider;
use App\Models\User;
use App\UseCases\User\CreateAction;
use App\UseCases\User\LoginAction;
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
     * email, passwordを受けDBにユーザー情報を仮登録
     * その後OTPをメールで送信する
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
            return response()->error($e->getCode(), $e->getMessage());
        }
        return response()->json(['success' => true, 'message' => 'ユーザー登録に成功しました'], Response::HTTP_CREATED);
    }

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

            // dd($user);

            //201になってる
            return UserWithTokenResource::from([
                'user' => $user,
                'token' => $token,
            ]);
        } catch (Exception $e) {
          Log::error(print_r($e->getMessage(), true));
          return response()->error($e->getCode(), $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();

        return response()->noContent();
    }

    public function update(UpdateRequest $request)
    {
      //TODO 動作確認後フロントと連携
      /**
       * @var UpdateProfileData $userData
       */
      $userData = $request->getAttributes();
      try {
        DB::beginTransaction();
        $user = Auth::guard('jwt')->user();
        if ($user instanceof User) {
          $user->update([
            'screen_name' => $userData->screen_name,
            'bio' => $userData->bio,
          ]);

          // SNSリンクの更新
          // 既存のリンクを全て削除
          $user->snsLinks()->delete();

         // SNSプロバイダーを取得
        $snsProviders = SnsProvider::whereIn('provider_name', array_column(SnsProviderType::cases(), 'value'))->get()->keyBy('provider_name');

        $snsLinks = [
            SnsProviderType::SPOTIFY->value => $userData->spotify,
            SnsProviderType::YOUTUBE->value => $userData->youtube,
            SnsProviderType::SOUNDCLOUD->value => $userData->soundcloud,
            SnsProviderType::APPLEMUSIC->value => $userData->applemusic,
            SnsProviderType::LINEMUSIC->value => $userData->linemusic,
            SnsProviderType::BANDCAMP->value => $userData->bandcamp,
            SnsProviderType::TWITTER->value => $userData->twitter,
        ];

        foreach ($snsLinks as $platform => $link) {
            if (!empty($link) && isset($snsProviders[$platform])) {
                $user->snsLinks()->create([
                    'sns_provider_id' => $snsProviders[$platform]->id,
                    'url' => $link,
                ]);
            }
        }
        }
        DB::commit();
      } catch(Exception $e) {
        Log::error(print_r($e->getMessage(), true));
      }

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

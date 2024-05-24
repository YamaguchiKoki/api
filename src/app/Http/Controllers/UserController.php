<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\User\CredentialData;
use App\Data\User\UserWithTokenData;
use App\Http\Requests\User\ActivateRequest;
use App\Http\Requests\User\CreateRequest;
use App\Http\Resources\UserResource;
use App\UseCases\User\ActivateAction;
use App\UseCases\User\Exceptions\DuplicateUserException;
use App\UseCases\User\RegisterByCredentialsAction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

final class UserController extends Controller
{
    //500errorの共通処理かく

    /**
     * ユーザー新規登録
     *
     * email, passwordを受けDBにユーザー情報を仮登録
     * その後OTPをメールで送信する
     *
     * @param CreateRequest $request
     * @param RegisterByCredentialsAction $create
     * @return JsonResponse
     */
    public function create(CreateRequest $request, RegisterByCredentialsAction $create): JsonResponse
    {
        /**
         * @var CredentialData $attributes
         */
        $attributes = $request->getAttributes();
        Log::debug(print_r($attributes, true));

        try {
            $create($attributes);
        } catch (DuplicateUserException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }

        return new JsonResponse(['success' => true, 'message' => '登録されたメールアドレス宛に認証コードを送信しました'],
            201
        );
    }

    public function activate(ActivateRequest $request, ActivateAction $activate): UserResource
    {
        /**
         * @var int $otp
         */
        $otp = $request->getAttributes();

        try {
            /**
             * @var UserWithTokenData $responseData
             */
            $responseData = $activate($otp);

            return new UserResource($responseData);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => '該当するリソースが見つかりませんでした'], 404);
        }
    }
}

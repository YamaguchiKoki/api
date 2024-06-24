<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Data\User\UserWithTokenData;
use App\Models\Otp;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Facades\JWTAuth;

final class ActivateAction
{
    public function __invoke(int $otp): UserWithTokenData
    {
        $cond = [
            'otp_code' => $otp,
            'is_used' => false,
        ];

        $validOtp = Otp::where($cond)->where('expired_at', '>', CarbonImmutable::now())->firstOrFail();
        $user = $validOtp->user;

        if (! $user) {
            throw new ModelNotFoundException();
        }

        $user->update(['status' => 1]);
        $token = JWTAuth::fromUser($user);

        return UserWithTokenData::from([
            'id' => $user->id,
            'token' => $token,
        ]);
    }
}

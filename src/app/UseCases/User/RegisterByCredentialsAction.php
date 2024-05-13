<?php
declare(strict_types=1);

namespace App\UseCases\User;

use App\Data\User\CredentialData;
use App\Jobs\SendVerificationEmail;
use App\Models\User;
use App\UseCases\User\Exceptions\DuplicateUserException;
use Illuminate\Auth\Events\Registered;

class RegisterByCredentialsAction
{
  public function __invoke(CredentialData $attributes): void
  {
    if(!$user = User::where('email', $attributes->email)->first()) {
      //入力情報と一致するユーザーがいなければ新規登録
      $newUser = User::create($attributes->toArray());

      $newUser->otps()->create([
        'otp_code' => mt_rand(100000, 999999),
        'expired_at' => now()->addMinute(3),
      ]);

      event(new Registered($newUser));
      dispatch(new SendVerificationEmail($newUser));
    } else if($user && $user->status === 0) {
      //仮登録ステータスであれば、otp再発行＆認証メール再送
      $user->otps()->create([
        'otp_code' => mt_rand(100000, 999999),
        'expired_at' => now()->addMinute(3),
      ]);

      event(new Registered($user));
      dispatch(new SendVerificationEmail($user));
    } else {
      //すでに登録済みなので例外を投げる
      throw new DuplicateUserException();
    }
  }
}

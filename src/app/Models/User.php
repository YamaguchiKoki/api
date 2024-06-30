<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

final class User extends Authenticatable implements JWTSubject
{
    use HasFactory, HasUlids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    //uuid設定
    public function newUniqueId()
    {
        return (string) Uuid::uuid4();
    }

    public function uniqueIds()
    {
        return ['id'];
    }

    //JWT設定
    public function getJWTIdentifier()
    {
        // JWT トークンに保存する ID を返す
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        // JWT トークンに埋め込む追加の情報を返す
        return [];
    }

    //リレーション

    public function otps()
    {
        return $this->hasMany(Otp::class);
    }

    // フォロー中のユーザーを取得
    public function followees()
    {
        return $this->belongsToMany(User::class, 'user_follows', 'follower_id', 'followee_id');
    }

    //フォローされているユーザーを取得
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follows', 'followee_id', 'follower_id');
    }

    public function brainDumps()
    {
        return $this->hasMany(BrainDump::class);
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function bookshelves()
    {
        return $this->hasMany(BookShelf::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedPlaylists()
    {
        return $this->belongsToMany(Playlist::class, 'likes');
    }

    public function snsLinks(): HasMany
    {
        return $this->hasMany(UserSnsLink::class);
    }
}

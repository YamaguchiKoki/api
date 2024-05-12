<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

final class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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

    public function otps()
    {
        return $this->hasMany(Otps::class);
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
}

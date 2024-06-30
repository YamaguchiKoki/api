<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSnsLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'provider_id', 'sns_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(SnsProvider::class, 'provider_id');
    }
}

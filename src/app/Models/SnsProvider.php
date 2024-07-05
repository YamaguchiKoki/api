<?php
namespace App\Models;

use App\Enums\SnsProviderType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SnsProvider extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_name',
    ];

    protected $casts = [
      'provider_name' => SnsProviderType::class
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_sns_links', 'provider_id', 'user_id')
                    ->withPivot('sns_user_id')
                    ->withTimestamps();
    }
}

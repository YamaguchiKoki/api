<?php
use Illuminate\Database\Eloquent\Model;

class SnsProvider extends Model
{
    protected $fillable = [
        'provider_name',
    ];

    public function snsLinks()
    {
        return $this->hasMany(UserSnsLink::class, 'provider_id');
    }
}

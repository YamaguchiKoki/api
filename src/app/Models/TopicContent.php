<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class TopicContent extends Model
{
    use HasFactory;

    public function topicable()
    {
        return $this->morphTo();
    }
}

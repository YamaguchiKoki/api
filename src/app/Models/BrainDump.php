<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class BrainDump extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(BrainDump::class);
    }

    public function items()
    {
        return $this->hasMany(BrainDumpItem::class);
    }

    public function topics()
    {
        return $this->morphMany(TopicContent::class, 'topicable');
    }

    public function bookshelves()
    {
        return $this->morphMany(BookShelfItem::class, 'itemable');
    }
}

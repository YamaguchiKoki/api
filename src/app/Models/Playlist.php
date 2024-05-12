<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Playlist extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topics()
    {
        return $this->morphMany(TopicContent::class, 'topicable');
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function bookshelves()
    {
        return $this->morphMany(BookShelfItem::class, 'itemable');
    }
}

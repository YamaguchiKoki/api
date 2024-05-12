<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class BookShelfItem extends Model
{
    use HasFactory;

    public function itemable()
    {
        return $this->morphTo();
    }
}

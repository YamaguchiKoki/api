<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class BrainDumpItem extends Model
{
    use HasFactory;

    public function brainDump()
    {
        return $this->belongsTo(BrainDump::class);
    }
}

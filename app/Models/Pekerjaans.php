<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pekerjaans extends Model
{
    use HasFactory;

    protected $fillable = ['pekerjaan'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Karyawans::class);
    }
}

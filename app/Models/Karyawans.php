<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawans extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'pekerjaan_id', 'divisi', 'status'];

    public function pekerjaan(): HasOne
    {
        return $this->hasOne(Pekerjaans::class, 'id');
    }
}

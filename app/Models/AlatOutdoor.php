<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatOutdoor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_alat',
        'harga_sewa',
        'is_active',
        'foto_alat',
        'deskripsi',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'resep';

    protected $primaryKey = 'kd_resep';

    protected $keyType = 'string';

    protected $fillable = [
        'kd_resep',
        'kd_produk',
        'kd_bahan',
        'ket',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $table = 'studio';
    protected $fillable = ["nama", "deskripsi", "lokasi", "jam_buka", "jam_tutup", "harga", "status", "peralatan", "thumbnail"];
}

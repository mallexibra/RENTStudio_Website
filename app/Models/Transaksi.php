<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = ['id_user', 'id_studio', 'nama', "harga", 'bukti', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function studios()
    {
        return $this->belongsTo(Studio::class, 'id_studio');
    }
}

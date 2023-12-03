<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';
    protected $fillable = ['id_user', 'id_studio', 'rating', 'deskripsi'];

    public function users()
    {
        return  $this->belongsTo(User::class, 'id_user');
    }
}

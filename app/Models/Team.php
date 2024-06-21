<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'password',
        'link_bukti_tf',
        'is_validated'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'kelompok_user', 'id_tim', 'user_id');
    }
}

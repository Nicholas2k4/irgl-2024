<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'tempat_lahir',
        'alamat',
        'kode_pos',
        'no_telp',
        'id_line',
        'link_foto',
        'is_ketua',
        'bank',
        'no_rek',
        'id_tim'
    ];
    public function team()
    {
        return $this->belongsTo(Team::class, 'id_tim');
    }
    
}

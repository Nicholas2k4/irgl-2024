<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Team extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    protected $fillable = [
        'nama',
        'password',
        'link_bukti_tf',
        'is_validated',
        'id_jadwal',
        'alasan_resched',
        'link_bukti_resched'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
}

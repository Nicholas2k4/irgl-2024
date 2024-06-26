<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'jadwal';

    protected $fillable = [
        'tanggal',
        'start_time',
        'end_time'
    ];

    public function teams()
    {
        return $this->hasMany(Team::class, 'id_jadwal');
    }
}

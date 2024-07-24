<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reschedule extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'reschedule';

    protected $fillable = [
        'id_kelompok',
        'id_jadwal_awal',
        'id_jadwal_resched',
        'alasan',
        'bukti',
        'approval'
    ];

    public function teams()
{
    return $this->belongsTo(Team::class, 'id_kelompok');
}
public function jadwalAwal()
{
    return $this->belongsTo(Jadwal::class, 'id_jadwal_awal');
}

public function jadwalResched()
{
    return $this->belongsTo(Jadwal::class, 'id_jadwal_resched');
}

}

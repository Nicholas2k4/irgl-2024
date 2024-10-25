<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class FinalStatistic extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'team_id',
        'score',
        'has_clue1',
        'has_clue2',
        'has_clue3',
        'has_clue4',
        'has_clue5',
        'has_clue6',
        'has_clue7',
        'has_clue8',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

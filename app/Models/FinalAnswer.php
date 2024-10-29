<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalAnswer extends Model
{
    use HasFactory;

    protected $table = 'final_answers';

    protected $fillable = [
        'question_id',
        'team_id',
        'answer',
        'is_correct',
        'incorrect_at',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function question()
    {
        return $this->belongsTo(FinalQuestion::class, 'question_id');
    }
}

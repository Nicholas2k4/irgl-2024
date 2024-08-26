<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SemiStatistic extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'semi_statistics';
    protected $fillable = [
        'id_team',
        'score',
        'email_filter',
        'encryption_machine',
        'traffic_controller',
        'antivirus',
        'input_validator',
    ];
}

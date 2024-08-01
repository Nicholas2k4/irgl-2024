<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'email',
        'division_name'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];   
}

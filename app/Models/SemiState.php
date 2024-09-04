<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemiState extends Model
{
    use HasFactory;

    public function news(){
        return SemiNew::where('slug', $this->current_news_slug)->firstOrFail();
    }
}

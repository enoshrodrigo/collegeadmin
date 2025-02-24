<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'link', 'status', 'date'];

    public function photos()
    {
        return $this->hasMany(EventPhoto::class)->orderBy('order');
    }
    
}

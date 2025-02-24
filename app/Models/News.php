<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'button_text',
        'action',
        'action_link',
        'status',
        'date',
        'more_info',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'registration_enabled','date'];

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
        'nic', 'dob', 'name', 'email', 'mobile_no', 'intake_id'
    ];

    public function intake()
    {
        return $this->belongsTo(Intake::class, 'intake_id');
    }
}

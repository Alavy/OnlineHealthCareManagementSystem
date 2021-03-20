<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'fee',
        'appointmentDate',
        'doctor_id',
        'patient_id'
    ];
    protected $casts = [
        'appointmentDate' => 'datetime',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'upload_date',
        'path',
        'approved'
    ];

    protected $visible = [
        'id',
        'upload_date', 
        'path'
    ];

    protected $casts = [
        'upload_date' => 'datetime',
    ];

}

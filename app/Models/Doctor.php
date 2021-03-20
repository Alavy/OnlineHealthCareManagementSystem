<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'averageConsultancyFee',
        'academicDegree',
        'designation',
        'diseaseSpecialist',
        'hospital',
        'address',
        'mobileNumber',
        'user_id',
        'weeklyInspec'
    ];
    
    public function patients(){
        return $this->belongsToMany(Patient::class)->using(Appointment::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}

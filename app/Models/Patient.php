<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'dateOfBirth',
        'sex',
        'maritalStatus',
        'bloodGroup',
        'address',
        'mobileNumber',
        'user_id'
    ];
    protected $casts = [
        'dateOfBirth' => 'datetime',
    ];
    public function doctors(){
        return $this->belongsToMany(Doctor::class)->using(Appointment::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}

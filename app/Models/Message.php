<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'doctor_id',
        'patient_id',
        'owner_user_id',
        'sendTime'
    ];
    protected $visible = [
        'id',
        'body', 
        'sendTime',
        'owner_user_id'
    ];
    public function getsendTimeAttribute($value)
    {
        return ucfirst($value);
    }
    protected $casts = [
        'sendTime' => 'datetime:Y-m-d H:i:s',
    ];
}

<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('message.{roomIdentity}', function ($user, $roomIdentity) {
    if($user->role == "doctor"){
        $room = DB::table('chat_rooms')
        ->select('chat_rooms.id as id')
        ->where('room_identity','=', $roomIdentity)
        ->where('doctor_id','=',$user->doctor->id)
        ->first();
        if($room === null || empty($room)){
            return false;
        }
        return true;

    }else if($user->role == "patient"){

        $room = DB::table('chat_rooms')
        ->select('chat_rooms.id as id')
        ->where('room_identity','=', $roomIdentity)
        ->where('patient_id','=',$user->patient->id)
        ->first();
        if($room === null || empty($room)){
            return false;
        }
        return true;

    }
    return false;
});

Broadcast::channel('prescription-upload', function ($user) {
    if($user->role == "admin"){
        return true;
    }
    return false;
});

Broadcast::channel('patient-register', function ($user) {
    if($user->role == "admin"){
        return true;
    }
    return false;
});

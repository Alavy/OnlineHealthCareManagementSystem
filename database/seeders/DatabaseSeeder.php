<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*
        Appointment::factory()->count(10)->state(new Sequence(
            ['fee' => 400.50],
            ['fee' => 300.56],
            ['fee'=> 1000.00]
        )) ->create();
        */
        
        
        User::factory()->state(function (array $attributes){
            return [
                'name' => "Alave",
                'email' => 'al@gmail.com',
                'email_verified_at' => now(),
                'role'=> 'admin',
                'approved'=>true,
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ];
        })->create();
    }
}

<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    private $sexArray = array('Male','Female');
    private $marritalArray = array('Married','UnMarried');
    private $bloodArray = array('A+','B+','AB+','A+','O+','O-','AB-','A-','B-');

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        $email = $this->faker->unique()->safeEmail;
        return [
            'user_id'=>User::factory()->state(function (array $attributes) use($name,$email) {
                return [
                    'role' => 'patient',
                    'name' => $name,
                    'email' => $email
                ];
            }),
            'dateOfBirth'=>$this->faker->dateTimeBetween('1990-01-01', '2012-12-31'),
            'sex'=>$this->sexArray[rand(0,sizeof($this->sexArray)-1)],
            'maritalStatus'=>$this->marritalArray[rand(0,sizeof($this->marritalArray)-1)],
            'bloodGroup'=>$this->bloodArray[rand(0,sizeof($this->bloodArray)-1)],
            'address'=>$this->faker->address,
            'mobileNumber'=>$this->faker->phoneNumber
        ];
    }
}

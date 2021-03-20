<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    private  $fee = array(500.50,600.50,700.50,1000.50);
    private  $degree = array('M.B.B.S','M.B.B.S, F.C.P.S','M.B.B.S , F.R.C.S');
    private  $designation =  array('Consultant','Professor','Senior Consultant');
    private  $spetialist =  array('Heart','Kidney','Medicine');
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
                    'role' => 'doctor',
                    'name' => $name,
                    'email' => $email
                ];
            }),
            'averageConsultancyFee'=>$this->fee[rand(0,sizeof($this->fee)-1)],
            'academicDegree'=>$this->degree[rand(0,sizeof($this->degree)-1)],
            'designation'=>$this->designation[rand(0,sizeof($this->designation)-1)],
            'diseaseSpecialist'=>$this->spetialist[rand(0,sizeof($this->spetialist)-1)],
            'hospital'=>'Texas General Hospital',
            'address'=>$this->faker->address,
            'weeklyInspec'=>utf8_encode('{"sat":[["10:00","13:00"],["14:00","18:00"]],"mon":[["10:00","13:00"],["14:00","18:00"]],"wed":[["10:00", "13:00"],["14:00","18:00"]],"fri":[["10:00", "13:00"],["14:00","20:00"]]}'),
            'mobileNumber'=>$this->faker->phoneNumber
        ];
    }
}

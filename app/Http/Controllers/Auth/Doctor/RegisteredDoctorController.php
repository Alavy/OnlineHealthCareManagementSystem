<?php

namespace App\Http\Controllers\Auth\Doctor;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Disease;
use App\Models\Message;

use App\Events\MessageEvent;


use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class RegisteredDoctorController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.admin.register-doctor');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'averageConsultancyFee' => 'required|numeric',
            'academicDegree' => 'required|string|max:200',
            'designation' => 'required|string',
            'diseaseSpecialist'=>'required|string',
            'hospital'=>'required|string',
            'address' => 'required|string|max:400',
            'mobileNumber' => 'required|max:14',
            
            'sat' => 'string|max:3',
            'sun' => 'string|max:3',
            'mon' => 'string|max:3',
            'tue' => 'string|max:3',
            'wed' => 'string|max:3',
            'thr' => 'string|max:3',
            'fri' => 'string|max:3'
            
        ]);

        $temp="{";
        $week=['sat','sun','mon','tue','wed','thr','fri'];
        foreach ($week as $day) 
        {
            if($request->input($day) !==null)
            {
                $index=1;
                $temp = $temp.'"'.$day.'":[';
                while ($request->input($day.$index.'1')!== null && 
                        !empty($request->input($day.$index.'1')) && 
                        $request->input($day.$index.'2')!== null && 
                        !empty($request->input($day.$index.'2'))) {
                    $temp = $temp.'[';
                    $temp = $temp.'"'.$request->input($day.$index.'1').'"';
                    $temp = $temp.',';
                    $temp = $temp.'"'.$request->input($day.$index.'2').'"';
                    $temp = $temp.'],';
                    $index++;
                }
                $temp = substr($temp, 0, -1);
                $temp = $temp.'],';
            }
        }
        $temp = substr($temp, 0, -1);
        $temp = $temp."}";

        if(strlen($temp) < 27){
            return \view('auth.admin.register-doctor')->withErrors(["Shedules"=>"please, add at least 1 Appointment Shedules"]);
        }
        
       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'doctor',
            'approved'=>true,
            'password' => Hash::make($request->password),
        ]);

        Doctor::create([
            'user_id'=>$user->id,
            'averageConsultancyFee' => $request->averageConsultancyFee,
            'academicDegree' => $request->academicDegree,
            'designation' => $request->designation,
            'diseaseSpecialist'=>$request->diseaseSpecialist,
            'hospital'=>$request->hospital,
            'address' => $request->address,
            'mobileNumber' => $request->mobileNumber,
            'weeklyInspec' => $temp

        ]);
        return redirect(RouteServiceProvider::HOME);
    }
    public function show()
    {
        $doctor = DB::table('users')
        ->join('doctors','users.id','=','doctors.user_id')
        ->select('users.name as name', 'users.email as email',
         'doctors.diseaseSpecialist as specialist',
          'doctors.averageConsultancyFee as fee', 'doctors.academicDegree as degree',
          'doctors.designation as designation','doctors.designation as designation',
          'doctors.hospital as hospital',
          'doctors.address as address','doctors.mobileNumber as mobileNumber',
          'doctors.weeklyInspec as weeklyInspec')
          ->where('doctors.id','=',Auth::user()->doctor->id)
          ->get()
          ->first();
        return view('auth.doctor.dashboard')->with('doctor',$doctor);
    }

    public function show_appointment()
    {
        $appoinments = DB::table('appointments')
            ->join('patients','appointments.patient_id','=','patients.id')
            ->join('users','users.id','=','patients.user_id')
            ->select('users.name as name','users.email as email',
            'patients.id as patient_id', 'patients.mobileNumber as mobileNumber',
            'appointments.appointmentDate as date','appointments.fee as fee')
            ->where('appointments.doctor_id','=',Auth::user()->doctor->id)
            ->get();
        return view('auth.doctor.show-appointment')->with('appoinments',$appoinments);
    }

    public function detail_appointment($patient_id)
    {
        if(empty($patient_id)){
            return redirect(RouteServiceProvider::HOME);
        }

        $patient = DB::table('patients')
            ->join('users','users.id','=','patients.user_id')
            ->select('users.name as name','users.email as email',
            'patients.mobileNumber as mobileNumber',
            'patients.dateOfBirth as dateOfBirth','patients.sex as sex',
            'patients.maritalStatus as maritalStatus','patients.bloodGroup as bloodGroup',
            'patients.address as address')
            ->where('patients.id','=',$patient_id)
            ->get()
            ->first();

        $appoinments = DB::table('appointments')
                        ->select('appointments.appointmentDate as date',
                                'appointments.fee as fee')
                        ->where('appointments.patient_id','=',$patient_id)
                        ->where('appointments.doctor_id','=',Auth::user()->doctor->id)
                        ->get();

        $prescriptions = DB::table('prescriptions')
            ->select('upload_date as date', 'path')
            ->where('patient_id','=',$patient_id)
            ->get();

        return \view('auth.doctor.detail-appointment')
        ->with('patient',$patient)
        ->with('appoinments',$appoinments)
        ->with('prescriptions',$prescriptions);
    }
    public function create_disease()
    {
        return \view('auth.doctor.create-disease');
    }
    public function post_create_disease(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'symptoms' => 'required|string',
        ]);

        Disease::create([
            'name'=> $request->name,
            'symptoms' => $request->symptoms,
            'doctor_id' => Auth::user()->doctor->id,

        ]);
        return redirect(RouteServiceProvider::HOME);
    }
    public function show_disease()
    {
        $diseases = DB::table('diseases')
            ->join('doctors','diseases.doctor_id','=','doctors.id')
            ->join('users','users.id','=','doctors.user_id')
            ->select('diseases.name as disease_name','diseases.symptoms as symptoms','users.name as doctor_name',
            'doctors.designation as designation','doctors.diseaseSpecialist as specialist')
            ->get();
        return view('auth.doctor.show-disease')->with('diseases',$diseases);
    }
    public function doctor_chat($patient_id)
    {
        if(empty($patient_id)){
            return redirect(RouteServiceProvider::HOME);
        }
        $name = DB::table('patients')
        ->join('users','users.id','=','patients.user_id')
        ->select('users.name as name')
        ->where('patients.id','=',$patient_id)
        ->first();

        $messages = DB::table('messages')
            ->select('messages.owner_user_id as owner_user_id',
            'messages.id as id','messages.body as body','messages.sendTime as sendTime')
            ->where('messages.doctor_id','=',Auth::user()->doctor->id)
            ->where('messages.patient_id','=',$patient_id)
            ->get();

        $roomIdentity = DB::table('chat_rooms')
            ->select('chat_rooms.room_identity as room_identity')
            ->where('patient_id','=', $patient_id)
            ->where('doctor_id','=',Auth::user()->doctor->id)
            ->first(); 

            if($roomIdentity==null || $name==null){
                return \redirect(\route('doctor.chat.list'));
            }

        return \view('auth.doctor.chat-window')
        ->with('messages',$messages)
        ->with('roomIdentity',$roomIdentity->room_identity)->with('name',$name->name)
        ->with('patient_id',$patient_id)
        ->with('own_user_id',Auth::user()->id);

    }

    public function post_doctor_chat(Request $request)
    {
        $request->validate([
            'messageBody' => 'required|string',
            'id' => 'required|integer'
        ]);

        $message = Message::create([
            'body'=> $request->messageBody,
            'sendTime'=>\now(),
            'patient_id' => $request->id,
            'owner_user_id'=>Auth::user()->id,
            'doctor_id'=> Auth::user()->doctor->id
        ]);

        $roomIdentity = DB::table('chat_rooms')
        ->select('chat_rooms.room_identity as room_identity')
        ->where('patient_id','=', $request->id)
        ->where('doctor_id','=',Auth::user()->doctor->id)
        ->first();

        broadcast(new MessageEvent($message,$roomIdentity->room_identity))->toOthers();

        return $message->toArray();

    }
    public function doctor_chat_list()
    {
        $patients = DB::table('messages')
        ->select('messages.patient_id')
        ->distinct()
        ->join('patients','patients.id','=','messages.patient_id')
        ->join('users','users.id','=','patients.user_id')
        ->select('users.name as name','patients.id as patient_id')
        ->where('messages.doctor_id','=',Auth::user()->doctor->id)
        ->get();
        return \view('auth.doctor.chat-list')->with('patients',$patients);
    }
    public function edit_doctor()
    {
        $doctor = DB::table('users')
        ->join('doctors','users.id','=','doctors.user_id')
        ->select('users.name as name', 'users.email as email',
         'doctors.diseaseSpecialist as specialist',
          'doctors.averageConsultancyFee as fee', 'doctors.academicDegree as degree',
          'doctors.designation as designation',
          'doctors.hospital as hospital',
          'doctors.address as address','doctors.mobileNumber as mobileNumber',
          'doctors.weeklyInspec as weeklyInspec')
          ->where('doctors.id','=',Auth::user()->doctor->id)
          ->get()
          ->first();
        return \view('auth.doctor.edit-doctor')->with('doctor',$doctor);
    }
    public function post_edit_doctor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'averageConsultancyFee' => 'required|numeric',
            'academicDegree' => 'required|string|max:200',
            'designation' => 'required|string',
            'diseaseSpecialist'=>'required|string',
            'hospital'=>'required|string',
            'address' => 'required|string|max:400',
            'mobileNumber' => 'required|max:25',
            
            'sat' => 'string|max:3',
            'sun' => 'string|max:3',
            'mon' => 'string|max:3',
            'tue' => 'string|max:3',
            'wed' => 'string|max:3',
            'thr' => 'string|max:3',
            'fri' => 'string|max:3'
            
        ]);
        $week=['sat','sun','mon','tue','wed','thr','fri'];
        $temp="{";
        foreach ($week as $day) 
        {
            if($request->input($day) !==null)
            {
                $index=1;
                $temp = $temp.'"'.$day.'":[';
                while ($request->input($day.$index.'1')!== null && 
                        !empty($request->input($day.$index.'1')) && 
                        $request->input($day.$index.'2')!== null && 
                        !empty($request->input($day.$index.'2'))) {
                    $temp = $temp.'[';
                    $temp = $temp.'"'.$request->input($day.$index.'1').'"';
                    $temp = $temp.',';
                    $temp = $temp.'"'.$request->input($day.$index.'2').'"';
                    $temp = $temp.'],';
                    $index++;
                }
                $temp = substr($temp, 0, -1);
                $temp = $temp.'],';
            }
        }
        $temp = substr($temp, 0, -1);
        $temp = $temp."}";

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $doctor = Doctor::find(Auth::user()->doctor->id);
        $doctor->averageConsultancyFee = $request->averageConsultancyFee;
        $doctor->academicDegree = $request->academicDegree;
        $doctor->designation = $request->designation;
        $doctor->diseaseSpecialist = $request->diseaseSpecialist;
        $doctor->hospital = $request->hospital;
        $doctor->address = $request->address;
        $doctor->mobileNumber = $request->mobileNumber;
        
        if(strlen($temp) >= 27){
            $doctor->weeklyInspec = $temp;
        }
        $doctor->save();

        
        return redirect(RouteServiceProvider::HOME);
    }

}

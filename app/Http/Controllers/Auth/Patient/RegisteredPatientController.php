<?php

namespace App\Http\Controllers\Auth\Patient;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Prescription;
use App\Models\Message;
use App\Models\ChatRoom;

use App\Events\PrescriptionUploadEvent;
use App\Events\MessageEvent;
use App\Events\PatientRegisterEvent;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;



class RegisteredPatientController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.patient.register');
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
            'dateOfBirth' => 'required',
            'sex' => 'required',
            'maritalStatus'=>'required',
            'bloodGroup'=>'required',
            'address' => 'required|string|max:400',
            'mobileNumber' => 'required|max:14'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'patient',
            'approved'=> false ,
            'password' => Hash::make($request->password),
        ]);

        $patient = Patient::create([
            'user_id'=> $user->id,
            'dateOfBirth' => $request->dateOfBirth,
            'sex' => $request->sex,
            'maritalStatus'=>$request->maritalStatus,
            'bloodGroup'=>$request->bloodGroup,
            'address' => $request->address,
            'mobileNumber' =>$request->mobileNumber
        ]);

        $pat = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'dateOfBirth' => $patient->dateOfBirth,
            'sex' => $patient->sex,
            'maritalStatus'=>$patient->maritalStatus,
            'bloodGroup'=>$patient->bloodGroup,
            'address' => $patient->address,
            'mobileNumber' =>$patient->mobileNumber
        ];

        broadcast(new PatientRegisterEvent($pat));
        
        return redirect(\route('register.success'));
    }
    public function show()
    {
        $patient = DB::table('patients')
            ->join('users','users.id','=','patients.user_id')
            ->select('users.name as name','users.email as email',
            'patients.mobileNumber as mobileNumber',
            'patients.dateOfBirth as dateOfBirth','patients.sex as sex',
            'patients.maritalStatus as maritalStatus','patients.bloodGroup as bloodGroup',
            'patients.address as address')
            ->where('patients.id','=',Auth::user()->patient->id)
            ->get()
            ->first();
        return \view('auth.patient.dashboard')->with('patient',$patient);
    }
    public function create_appointment($doctor_id)
    {
        if(empty($doctor_id)){
            return redirect(RouteServiceProvider::HOME);
        }
        $week = Doctor::find($doctor_id)->weeklyInspec;
        return view('auth.patient.create-appointment')->with('doctor_id',$doctor_id)->with('week',$week);
    }
    public function store_appointment(Request $request)
    {
        $request->validate([
            'appointmentDate' => 'required|date',
            'doctor_id' => 'required|integer',
            'appointmentTime'=> 'required'
        ]);
        $doctor_id = $request->doctor_id;
        $doctor = Doctor::find($doctor_id);
       
        if(empty($doctor)){
            return redirect(RouteServiceProvider::HOME);
        }
        
        Appointment::create([
            'doctor_id'=> $doctor_id,
            'patient_id' => $request->user()->patient->id,
            'appointmentDate' => $request->appointmentDate.' '.$request->appointmentTime,
            'fee'=>$doctor->averageConsultancyFee
        ]);



        $room = DB::table('chat_rooms')
            ->select('chat_rooms.id as id')
            ->where('patient_id','=', $request->user()->patient->id)
            ->where('doctor_id','=',$doctor_id)
            ->first();
        if($room === null || empty($room)){

            ChatRoom::create([
                'patient_id' =>$request->user()->patient->id,
                'doctor_id'=> $doctor_id,
                'room_identity'=>'_'.time().'__',
                ]);
        }
             
        return redirect(RouteServiceProvider::HOME);
    }

    public function search_doctor(Request $request)
    {
        return view('auth.patient.search-doctor');
    }

    public function post_search_doctor(Request $request)
    {
        $request->validate([
            'searchDoctor' => 'required|string|max:1000'
        ]);
        $q = $request->searchDoctor;      
        $doctors = DB::table('users')
            ->join('doctors','users.id','=','doctors.user_id')
            ->select('users.name as name', 'users.email as email','doctors.id as id',
             'doctors.diseaseSpecialist as specialist',
              'doctors.averageConsultancyFee as fee', 'doctors.academicDegree as degree',
              'doctors.designation as designation','doctors.designation as designation',
              'doctors.hospital as hospital',
              'doctors.address as address','doctors.mobileNumber as mobileNumber',
              'doctors.weeklyInspec as weeklyInspec')
            ->where('users.name','LIKE','%'.$q.'%')
            ->orWhere('users.email','LIKE','%'.$q.'%')
            ->orWhere('doctors.diseaseSpecialist','LIKE','%'.$q.'%')
            ->orWhere('doctors.hospital','LIKE','%'.$q.'%')
            ->orWhere('doctors.academicDegree','LIKE','%'.$q.'%')
            ->orWhere('doctors.mobileNumber','LIKE','%'.$q.'%')
            ->get();
        return view('auth.patient.search-doctor')->with('doctors',$doctors);
    }
    public function show_appointment(){

        $appoinments = DB::table('appointments')
                        ->join('doctors','appointments.doctor_id','=','doctors.id')
                        ->join('users','users.id','=','doctors.user_id')
                        ->select('users.name as name','users.email as email','doctors.id as doctor_id',
                        'doctors.mobileNumber as mobileNumber','doctors.diseaseSpecialist as specialist',
                        'doctors.hospital as hospital',
                        'doctors.academicDegree as degree','doctors.designation as designation',
                        'appointments.appointmentDate as date','appointments.fee as fee',
                        'doctors.address as address')
                        ->where('appointments.patient_id','=',Auth::user()->patient->id)
                        ->get();

        return view('auth.patient.show-appointment')->with('appoinments',$appoinments);
    }
    public function search_disease()
    {
        return \view('auth.patient.search-disease');
    }
    public function post_search_disease(Request $request)
    {
        $request->validate([
            'searchDisease' => 'required|string|max:1000'
        ]);
        $q = $request->searchDisease;
        
        $diseases = DB::table('diseases')
            ->join('doctors','diseases.doctor_id','=','doctors.id')
            ->join('users','users.id','=','doctors.user_id')
            ->select('diseases.name as disease_name','diseases.symptoms as symptoms','users.name as doctor_name',
            'doctors.designation as designation','doctors.diseaseSpecialist as specialist')
            ->where('diseases.name','LIKE','%'.$q.'%')
            ->orWhere('diseases.symptoms','LIKE','%'.$q.'%')
            ->get();
        return \view('auth.patient.search-disease')->with('diseases',$diseases);
    }
    public function upload_prescription()
    {
        return \view('auth.patient.upload-prescription');
    }
    public function post_upload_prescription(Request $request)
    {
        $request->validate([
            'prescription_file' => 'required|file|mimes:jpeg,bmp,png,jpg'
        ]);
        if ($request->hasFile('prescription_file')) {

            $request->prescription_file->store('prescription', 'public');

            $pres = Prescription::create([
                'patient_id'=> Auth::user()->patient->id,
                'upload_date' => now(),
                'path'=> $request->prescription_file->hashName(),
                'approved'=>false
            ]);

            broadcast(new PrescriptionUploadEvent($pres));

        }

        return redirect(RouteServiceProvider::HOME);

    }
    public function show_prescription()
    {
        $prescriptions = DB::table('prescriptions')
            ->select('upload_date as date', 'path')
            ->where('patient_id','=',Auth::user()->patient->id)
            ->where('approved','=',true)
            ->get();
        return \view('auth.patient.show-prescriptions')->with('prescriptions',$prescriptions);
    }
    public function check_disease()
    {
        $symptoms =  DB::table('diseases')
            ->select('symptoms')
            ->get();
        $arr=[];
        foreach ($symptoms as $item) {
            $temp = preg_split("/[1-9]+[ ]*[.]/i", $item->symptoms);
            for ($i=1; $i<count($temp) ; $i++) { 
                array_push($arr, trim($temp[$i]));
            }
        }
        $arr = array_unique($arr);
        return \view('auth.patient.check-disease')->with('arr',$arr);
    }
    public function post_check_disease(Request $request)
    {
        $q="";
        for ($i=0;; $i++) {
            if($request->input('sym_'.$i)!== null && !empty($request->input('sym_'.$i))){
                $q=$request->input('sym_'.$i);
                break;
            }
        }
        $diseases = DB::table('diseases')
            ->join('doctors','diseases.doctor_id','=','doctors.id')
            ->join('users','users.id','=','doctors.user_id')
            ->select('diseases.name as disease_name','diseases.symptoms as symptoms','users.name as doctor_name',
            'doctors.designation as designation','doctors.id as id','doctors.diseaseSpecialist as specialist')
            ->orWhere('diseases.symptoms','LIKE','%'.$q.'%')
            ->get();
        return \view('auth.patient.check-disease')->with('diseases',$diseases);
    }
    public function edit_patient()
    {
        $patient = DB::table('patients')
            ->join('users','users.id','=','patients.user_id')
            ->select('users.name as name','users.email as email',
            'patients.mobileNumber as mobileNumber',
            'patients.dateOfBirth as dateOfBirth','patients.sex as sex',
            'patients.maritalStatus as maritalStatus','patients.bloodGroup as bloodGroup',
            'patients.address as address')
            ->where('patients.id','=',Auth::user()->patient->id)
            ->get()
            ->first();
        return \view('auth.patient.patient-edit')->with('patient',$patient);
    }
    public function post_edit_patient(Request $request)
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
            'dateOfBirth' => 'required',
            'sex' => 'required',
            'maritalStatus'=>'required',
            'bloodGroup'=>'required',
            'address' => 'required|string|max:400',
            'mobileNumber' => 'required|max:20'
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $patient = Patient::find(Auth::user()->patient->id);
        $patient->dateOfBirth = $request->dateOfBirth;
        $patient->sex = $request->sex;
        $patient->maritalStatus = $request->maritalStatus;
        $patient->bloodGroup = $request->bloodGroup;
        $patient->address = $request->address;
        $patient->mobileNumber = $request->mobileNumber;
        $patient->save();

        return redirect(RouteServiceProvider::HOME);
    }

    public function patient_chat($doctor_id)
    {
        if(empty($doctor_id)){
            return redirect(RouteServiceProvider::HOME);
        }
        $name = DB::table('doctors')
        ->join('users','users.id','=','doctors.user_id')
        ->select('users.name as name')
        ->where('doctors.id','=',$doctor_id)
        ->first();

        $messages = DB::table('messages')
            ->select('messages.owner_user_id as owner_user_id','messages.id as id','messages.body as body','messages.sendTime as sendTime')
            ->where('messages.patient_id','=',Auth::user()->patient->id)
            ->where('messages.doctor_id','=',$doctor_id)
            ->get();

        $roomIdentity = DB::table('chat_rooms')
        ->select('chat_rooms.room_identity as room_identity')
        ->where('doctor_id','=', $doctor_id)
        ->where('patient_id','=',Auth::user()->patient->id)
        ->first();
        if($roomIdentity==null || $name==null){
            return \redirect(\route('patient.chat.list'));
        }
        return \view('auth.patient.chat-window')
        ->with('messages',$messages)
        ->with('roomIdentity',$roomIdentity->room_identity)->with('name',$name->name)
        ->with('doctor_id',$doctor_id)
        ->with('own_user_id',Auth::user()->id);

    }

    public function post_patient_chat(Request $request)
    {
        $request->validate([
            'messageBody' => 'required|string',
            'id' => 'required|integer'
        ]);

        $message = Message::create([
            'body'=> $request->messageBody,
            'sendTime'=>\now(),
            'doctor_id' => $request->id,
            'owner_user_id'=>Auth::user()->id,
            'patient_id'=> Auth::user()->patient->id
        ]);

        $roomIdentity = DB::table('chat_rooms')
        ->select('chat_rooms.room_identity as room_identity')
        ->where('doctor_id','=', $request->id)
        ->where('patient_id','=',Auth::user()->patient->id)
        ->first();

        broadcast(new MessageEvent($message,$roomIdentity->room_identity))->toOthers();

        return $message->toArray();
    }
    public function patient_chat_list()
    {
        $doctors = DB::table('messages')
        ->select('messages.doctor_id')
        ->distinct()
        ->join('doctors','doctors.id','=','messages.doctor_id')
        ->join('users','users.id','=','doctors.user_id')
        ->select('users.name as name','doctors.id as doctor_id')
        ->where('messages.patient_id','=',Auth::user()->patient->id)
        ->get();
        return \view('auth.patient.chat-list')->with('doctors',$doctors);
    }

}
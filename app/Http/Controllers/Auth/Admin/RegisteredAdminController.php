<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Prescription;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class RegisteredAdminController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.admin.register-admin');
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
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin',
            'approved'=>true,
            'password' => Hash::make($request->password),
        ]);
        return redirect(RouteServiceProvider::HOME);
    }
    public function edit_admin()
    {
        $admin = DB::table('users')->select('name',
                'email')
                ->where('users.id','=',Auth::user()->id)
                ->get()
                ->first();

        return \view('auth.admin.edit-admin')->with('admin',$admin);
    }
    public function post_edit_admin(Request $request)
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
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;

        if( isset($request->password) && !empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect(RouteServiceProvider::HOME);
    }
    public function show()
    {
        $admin = DB::table('users')->select('name',
                'email')
                ->where('users.id','=',Auth::user()->id)
                ->get()
                ->first();

        return view('auth.admin.dashboard')->with('admin',$admin);
    }

    public function show_patient()
    {
        return view('auth.admin.show-patient');
    }
    public function post_show_patient(Request $request)
    {
        $request->validate([
            'searchPatient' => 'required|string|max:1000'
        ]);
        $q = $request->searchPatient;      
        $patients = DB::table('users')
            ->join('patients','users.id','=','patients.user_id')
            ->select('users.name as name', 'users.email as email',
                'patients.dateOfBirth as dateOfBirth',
                'patients.sex as sex', 'patients.maritalStatus as maritalStatus',
                'patients.bloodGroup as bloodGroup','patients.address as address',
                'patients.mobileNumber as mobileNumber')
            ->where('users.name','LIKE','%'.$q.'%')
            ->where('users.approved','=',true)
            ->orWhere('users.email','LIKE','%'.$q.'%')
            ->orWhere('patients.sex','LIKE','%'.$q.'%')
            ->orWhere('patients.bloodGroup','LIKE','%'.$q.'%')
            ->orWhere('patients.mobileNumber','LIKE','%'.$q.'%')
            ->get();
        return view('auth.admin.show-patient')->with('patients',$patients);;
    }
    public function show_doctor()
    {
        return view('auth.admin.show-doctor');
    }
    public function post_show_doctor(Request $request)
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
            ->orWhere('doctors.academicDegree','LIKE','%'.$q.'%')
            ->orWhere('doctors.mobileNumber','LIKE','%'.$q.'%')
            ->get();
        return view('auth.admin.show-doctor')->with('doctors',$doctors);
    }
    public function upload_approve_admin()
    {
        $prescriptions = DB::table('prescriptions')
            ->select('prescriptions.id as id','prescriptions.upload_date as upload_date', 'prescriptions.path as path',)
            ->where('prescriptions.approved','=',false)
            ->get();
        return \view('auth.admin.upload-approve')->with('prescriptions',$prescriptions);
    }
    public function post_upload_approve_admin(Request $request)
    {
        $request->validate([
            'prescription_id' => 'required|integer'
        ]);

        $pres = Prescription::find($request->prescription_id);
        $pres->approved = true;
        $pres->save();

        return \redirect(\route('admin.upload.approve'));
    }
    public function upload_data_all()
    {
        $num = DB::table('prescriptions')
        ->select('prescriptions.id as id')
        ->where('prescriptions.approved','=',false)
        ->get()
        ->count();

        return $num;
    }
    public function patient_approve_admin()
    {
        $patients = DB::table('users')
            ->join('patients','users.id','=','patients.user_id')
            ->select('users.id as id','users.name as name', 'users.email as email',
                'patients.dateOfBirth as dateOfBirth',
                'patients.sex as sex', 'patients.maritalStatus as maritalStatus',
                'patients.bloodGroup as bloodGroup','patients.address as address',
                'patients.mobileNumber as mobileNumber')
            ->where('users.approved','=',false)
            ->get();
        return \view('auth.admin.patient-approve')->with('patients',$patients);
    }
    public function post_patient_approve_admin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer'
        ]);

        $user = User::find($request->user_id);
        $user->approved = true;
        $user->save();

        return \redirect(\route('admin.patient.approve'));
    }
    public function patient_data_all()
    {
        $num = DB::table('users')
        ->select('users.id as id')
        ->where('users.approved','=',false)
        ->get()
        ->count();

        return $num;
    }

}

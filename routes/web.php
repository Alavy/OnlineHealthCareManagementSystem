<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\Admin\RegisteredAdminController;
use App\Http\Controllers\Auth\Doctor\RegisteredDoctorController;
use App\Http\Controllers\Auth\Patient\RegisteredPatientController;
use Illuminate\Http\Request;
use App\Events\PrescriptionUploadEvent;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('/aboutus', function () {
    return view('index');
})->name('about.us');
Route::get('/free/service', function () {
    return view('index');
})->name('free.service');
Route::get('/terms/condition', function () {
    return view('index');
})->name('terms.condition');
Route::get('privacy/policy', function () {
    return view('index');
})->name('privacy.policy');
Route::get('contact/us', function () {
    return view('index');
})->name('contact.us');

Route::get('register/success', function () {
        return view('register-success');
})->name('register.success');

/*
Route::get('event', function () {
     return \event(new PrescriptionUploadEvent(23));
});
*/


//admin
Route::get('/dashboard/admin',[RegisteredAdminController::class,'show'])
        ->middleware(['auth','admin']);
Route::get('/dashboard/admin/show/patient',[RegisteredAdminController::class,'show_patient'])
        ->middleware(['auth','admin'])->name('admin.show.patient');
Route::post('/dashboard/admin/show/patient',[RegisteredAdminController::class,'post_show_patient'])
        ->middleware(['auth','admin']);
Route::get('/dashboard/admin/show/doctor',[RegisteredAdminController::class,'show_doctor'])
        ->middleware(['auth','admin'])->name('admin.show.doctor');
Route::post('/dashboard/admin/show/doctor',[RegisteredAdminController::class,'post_show_doctor'])
        ->middleware(['auth','admin']);

Route::get('/dashboard/admin/edit',[RegisteredAdminController::class,'edit_admin'])
        ->middleware(['auth','admin'])->name('admin.edit');
Route::post('/dashboard/admin/edit',[RegisteredAdminController::class,'post_edit_admin'])
        ->middleware(['auth','admin']);

Route::get('/dashboard/admin/upload/approve',[RegisteredAdminController::class,'upload_approve_admin'])
        ->middleware(['auth','admin'])->name('admin.upload.approve');
Route::post('/dashboard/admin/upload/approve',[RegisteredAdminController::class,'post_upload_approve_admin'])
        ->middleware(['auth','admin']);

Route::get('/admin/upload/data/all',[RegisteredAdminController::class,'upload_data_all'])
        ->middleware(['auth','admin'])->name('admin.upload.data');


Route::get('/dashboard/admin/patient/approve',[RegisteredAdminController::class,'patient_approve_admin'])
        ->middleware(['auth','admin'])->name('admin.patient.approve');
Route::post('/dashboard/admin/patient/approve',[RegisteredAdminController::class,'post_patient_approve_admin'])
        ->middleware(['auth','admin']);

Route::get('/admin/patient/data/all',[RegisteredAdminController::class,'patient_data_all'])
        ->middleware(['auth','admin'])->name('admin.patient.data');

//doctor
Route::get('/dashboard/doctor',[RegisteredDoctorController::class,'show'])
        ->middleware(['auth','doctor']);
Route::get('/dashboard/doctor/appointment',[RegisteredDoctorController::class,'show_appointment'])
        ->middleware(['auth','doctor'])->name('doctor.show.appointment');

Route::get('/dashboard/doctor/appointment/details/{patient_id?}',[RegisteredDoctorController::class,'detail_appointment'])
        ->middleware(['auth','doctor'])->name('doctor.detail.appointment');

Route::get('/dashboard/create/disease',[RegisteredDoctorController::class,'create_disease'])
        ->middleware(['auth','doctor'])->name('doctor.create.disease');
Route::post('/dashboard/create/disease',[RegisteredDoctorController::class,'post_create_disease'])
        ->middleware(['auth','doctor']);
        
Route::get('/dashboard/show/disease',[RegisteredDoctorController::class,'show_disease'])
        ->middleware(['auth','doctor'])->name('doctor.show.disease');

//chating
Route::get('/dashboard/doctor/chat/list',[RegisteredDoctorController::class,'doctor_chat_list'])
        ->middleware(['auth','doctor'])->name('doctor.chat.list');

Route::get('/dashboard/doctor/chat/{patient_id}',[RegisteredDoctorController::class,'doctor_chat'])
        ->middleware(['auth','doctor']);

Route::post('/dashboard/doctor/chat',[RegisteredDoctorController::class,'post_doctor_chat'])
        ->middleware(['auth','doctor'])->name('doctor.chat.post');

Route::get('/dashboard/doctor/edit',[RegisteredDoctorController::class,'edit_doctor'])
        ->middleware(['auth','doctor'])->name('doctor.edit');

Route::post('/dashboard/doctor/edit',[RegisteredDoctorController::class,'post_edit_doctor'])
        ->middleware(['auth','doctor']);


//patient       
Route::get('/dashboard/patient',[RegisteredPatientController::class,'show'])
        ->middleware(['auth','patient']);

Route::get('/dashboard/patient/show/appointment',[RegisteredPatientController::class,'show_appointment'])
        ->middleware(['auth','patient'])->name('patient.show.appointment');
Route::get('/dashboard/patient/search/doctor',[RegisteredPatientController::class,'search_doctor'])
        ->middleware(['auth','patient'])->name('patient.search.doctor');
Route::post('/dashboard/patient/search/doctor',[RegisteredPatientController::class,'post_search_doctor'])
        ->middleware(['auth','patient']);
Route::get('/dashboard/patient/create/appointment/{doctor_id?}',[RegisteredPatientController::class,'create_appointment'])
        ->middleware(['auth','patient'])->name('patient.create.appointment');
Route::post('/dashboard/patient/create/appointment',[RegisteredPatientController::class,'store_appointment'])
        ->middleware(['auth','patient']);

Route::get('/dashboard/patient/upload/prescription',[RegisteredPatientController::class,'upload_prescription'])
        ->middleware(['auth','patient'])->name('patient.upload.prescription');
Route::post('/dashboard/patient/upload/prescription',[RegisteredPatientController::class,'post_upload_prescription'])
        ->middleware(['auth','patient']);
Route::get('/dashboard/patient/show/prescription',[RegisteredPatientController::class,'show_prescription'])
        ->middleware(['auth','patient'])->name('patient.show.prescription');

Route::get('/dashboard/patient/search/disease',[RegisteredPatientController::class,'search_disease'])
        ->middleware(['auth','patient'])->name('patient.search.disease');
Route::post('/dashboard/patient/search/disease',[RegisteredPatientController::class,'post_search_disease'])
        ->middleware(['auth','patient']);

Route::get('/dashboard/patient/check/disease',[RegisteredPatientController::class,'check_disease'])
        ->middleware(['auth','patient'])->name('patient.check.disease');
Route::post('/dashboard/patient/check/disease',[RegisteredPatientController::class,'post_check_disease'])
        ->middleware(['auth','patient']);

Route::get('/dashboard/patient/edit',[RegisteredPatientController::class,'edit_patient'])
        ->middleware(['auth','patient'])->name('patient.edit');
Route::post('/dashboard/patient/edit',[RegisteredPatientController::class,'post_edit_patient'])
        ->middleware(['auth','patient']);

//chating
Route::get('/dashboard/patient/chat/list',[RegisteredPatientController::class,'patient_chat_list'])
        ->middleware(['auth','patient'])->name('patient.chat.list');

Route::get('/dashboard/patient/chat/{doctor_id}',[RegisteredPatientController::class,'patient_chat'])
        ->middleware(['auth','patient']);

Route::post('/dashboard/patient/chat',[RegisteredPatientController::class,'post_patient_chat'])
        ->middleware(['auth','patient'])->name('patient.chat.post');
        

//dashboard
Route::get('/dashboard',function(Request $request){
    return redirect('/dashboard/'.$request->user()->role);
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

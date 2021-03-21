# Online Health Care Management System
### Online HealthCare Management System is powerful, flexible, and easy to use platform developed to minimize the managerial constaraints the health industry commonly faced.
# Features 
* Admin Panel: Manages the system's overall process 
    + Update Own Information
    + Register Other Admin
    + Register Doctor
    + Approve Patient's Register Request
    + Approve Patient's Prescription upload Request
    + Search Patient's Information
    + Search Doctor's Information

* Doctor Panel :
    + Update Own Information
    + Visit Own Appointment List
    + Visit Detail information about appointed patient
    + Create commonly known disease
    + Realtime Chat with Patient

* Patient Panel :
    + Update Own Information
    + Search Doctor and Create Appontment with doctor
    + search Disease
    + upload prescriptions
    + Realtime Chat with Doctor


# Setup
* Git Clone the Project
* Install the Xampp and place the project in htdocs(Xammp's install location) folder
* Intall Composer 
* Open project with VS code
* Open the terminal on Vscode and Run the Following Commands
    + composer install
    + npm install
    + npm run dev
* Now in Xammp Open Php myadmin and create a databse with name'doctor_mangement'
* Then Run this Following only once Command
    + php artisan migrate:fresh
    + php artisan db:seed
    + php artisan storage:link
    + php artisan websockets:serve
* Now Every time you open this project then you have to run foloowing command only
    + php artisan websockets:serve
* you can visit the website from browser typing 'localhost'
* you have to login the project with default admin credential
    + User Name: al@gmail.com
    + Password : password
* from there you can approve patient's register request




# Technologies used in this project
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

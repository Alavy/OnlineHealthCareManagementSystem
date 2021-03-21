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
* Now in Xammp Open Php myadmin and create a databse with name 'doctor_mangement'
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

# 1 . Laravel 
<p><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p>
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 2. Laravel WebSockets :

[![Latest Version on Packagist](https://img.shields.io/packagist/v/beyondcode/laravel-websockets.svg?style=flat-square)](https://packagist.org/packages/beyondcode/laravel-websockets)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/beyondcode/laravel-websockets/run-tests?label=tests)
[![Quality Score](https://img.shields.io/scrutinizer/g/beyondcode/laravel-websockets.svg?style=flat-square)](https://scrutinizer-ci.com/g/beyondcode/laravel-websockets)
[![Total Downloads](https://img.shields.io/packagist/dt/beyondcode/laravel-websockets.svg?style=flat-square)](https://packagist.org/packages/beyondcode/laravel-websockets)

# 3. Alpine.js

![npm bundle size](https://img.shields.io/bundlephobia/minzip/alpinejs)
![npm version](https://img.shields.io/npm/v/alpinejs)
[![Chat](https://img.shields.io/badge/chat-on%20discord-7289da.svg?sanitize=true)](https://alpinejs.codewithhugo.com/chat/)

# 4. Tailwind CSS
<p>
    <a href="https://tailwindcss.com/" target="_blank">
      <img alt="Tailwind CSS" width="350" src="https://refactoringui.nyc3.cdn.digitaloceanspaces.com/tailwind-logo.svg">
    </a><br>
    A utility-first CSS framework for rapidly building custom user interfaces.
</p>

<p>
    <a href="https://travis-ci.org/tailwindcss/tailwindcss"><img src="https://img.shields.io/travis/tailwindcss/tailwindcss/master.svg" alt="Build Status"></a>
    <a href="https://www.npmjs.com/package/tailwindcss"><img src="https://img.shields.io/npm/dt/tailwindcss.svg" alt="Total Downloads"></a>
    <a href="https://github.com/tailwindcss/tailwindcss/releases"><img src="https://img.shields.io/npm/v/tailwindcss.svg" alt="Latest Release"></a>
    <a href="https://github.com/tailwindcss/tailwindcss/blob/master/LICENSE"><img src="https://img.shields.io/npm/l/tailwindcss.svg" alt="License"></a>
    <a href="https://codecov.io/gh/tailwindlabs/tailwindcss"><img src="https://codecov.io/gh/tailwindlabs/tailwindcss/coverage.svg?branch=master" alt="Code Coverage"></a>
</p>

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

<p align="center"><a href="https://timedoor.net" target="_blank"><img src="https://timedoor.net/wp-content/themes/timedoor/images/icons/logo-timedoor-black.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

Named Catalyst :green_heart:, this project created for tracking and manage Timedoor Indonesia's projects as a software company and blogs. This project contains 3 roles of users which is Admin, Project Manager and Programmer.

## Get Started

To run the app, you need to follow the installation step below.

- Clone this project to your machine.
- Run `composer install` to install all the vendors used in this project.
- Run `php artisan migrate` to generate all database tables used in this project.
- Run `php artisan db:seed --class="RoleSeeder"` to generate all role in the database.
- Run `php artisan db:seed --class="DivisionSeeder"` to generate all division in the database.
- Run `php artisan db:seed --class="AdminSeeder"` to generate Admin roled user.
- Run `php artisan db:seed --class="ProjectManagerSeeder"` to generate Project Manager roled user (or also can be created on Admin dashboard).
- Run `php artisan db:seed --class="ProgrammerSeeder"` to generate Programmer roled user (or also can be created on Admin dashboard).
- Run `php artisan db:seed"` to generate 10 dummy Programmer roled user.
- Run `php artisan serve` to run the app.
- Enjoy :+1:

## User Credentials

If you already generate all the user based on instruction above, you can login through the app with the credentials below.

Login Form : baseurl/login

###### Admin
Email    : admin@timedoor.com\
Password : admin

###### Project Manager
Email    : pm@timedoor.com\
Password : projectmanager

###### Programmer
Email    : programmer@timedoor.com\
Password : programmer
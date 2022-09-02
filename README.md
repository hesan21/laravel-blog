<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel Blog App

## Installation Guide

First, Clone this repository. ( Make sure you've PHP 8+ installed because, we are using Laravel 9 which requires PHP 8 )

Then, run the following command to install dependencies:

> composer install

After that, create a `.env` file. Either just copy paste the `.env.example` and rename it.
Or,
use the following command in your project root directory:

> cp .env.example .env

Now, execute the following command to generate `APP_KEY`:

> php artisan key:generate

Now, Setup your DB Credentials and replace it inside the `.env` file. Once DB is Setup and Credentials are added, run migrations using:

> php artisan migrate

Next, you need to install frontend dependencies and compile your assets.
So, run the following commands:

> npm i && npm run dev

Keep `npm run dev` running because Laravel 9+ works with vite instead of Laravel Mix.

Now,run the server:

> php artisan serve

That's it!.
Modify as per your need. 

## Enjoy!

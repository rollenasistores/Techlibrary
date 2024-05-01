<?php

use App\Models\Borrow;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::call(function () {
    
    $borrow = Borrow::get()->where('returned_at', now());

    dd($borrow->returned_at);



})->daily();
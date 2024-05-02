<?php

use App\Mail\ReturnBookEmail;
use App\Models\Borrow;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {

    $borrows = Borrow::with('user')->where('confirmed', 0)
    ->whereDate('returned_at', today())
    ->get();

    foreach ($borrows as $borrow) {

        Mail::to($borrow->user['email'])->send(new ReturnBookEmail($borrow->user['name'], $borrow->returned_at, $borrow->copy->book->name));
    }

})->twiceDaily(8, 13);

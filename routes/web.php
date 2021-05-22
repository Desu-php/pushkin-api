<?php

use App\Mail\NewslettersSend;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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
    $contestant  = \App\Models\Contestant::find(1);
    return view('pdf.pdf', compact('contestant'));
//
    Mail::to('ledforyou.online@gmail.com')
        ->send(new NewslettersSend($contestand));
});

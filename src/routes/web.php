<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\Email\EmailController;

Route::get('/',[HomeController::class, "index"])->name("home");
Route::post('/send-email',[EmailController::class, "send"])->name("send_mail");
Route::get('{id}/success',[EmailController::class, "success"])->name("success_sent");

Route::fallback(fn() => abort(404));

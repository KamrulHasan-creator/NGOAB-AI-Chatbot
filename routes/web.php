<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Main Website
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    app()->setLocale(
        session('locale', 'bn')
    );

    return view('welcome');

});


/*
|--------------------------------------------------------------------------
| Chatbot Test Page
|--------------------------------------------------------------------------
*/

Route::get('/chatbot-test', function () {

    app()->setLocale(
        session('locale', 'bn')
    );

    return view('chatbot-test');

});


/*
|--------------------------------------------------------------------------
| Chatbot API Endpoint
|--------------------------------------------------------------------------
|
| IMPORTANT:
| welcome.blade.php contains the chatbot backend.
|
| GET  -> welcome page
| POST -> chatbot request is intercepted inside welcome.blade.php
|
*/

Route::match(['get', 'post'], '/chatbot/message', function () {

    // app()->setLocale(
    //     session('locale', 'bn')
    // );

    return "Hey";

});


/*
|--------------------------------------------------------------------------
| Language Switch
|--------------------------------------------------------------------------
*/

Route::get('/language/{locale}', function ($locale) {

    if (!in_array($locale, ['bn','en'], true)) {

        abort(404);

    }


    session([
        'locale' => $locale
    ]);


    /*
    |--------------------------------------------------------------------------
    | Keep Laravel application locale synchronized immediately
    |--------------------------------------------------------------------------
    */

    app()->setLocale(
        $locale
    );


    return redirect()->back();

})->name('language.switch');

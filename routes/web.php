<?php

$error_reporting = E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED;


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
require_once base_path('vendor/autoload.php');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', function () {

    //  dd(messageeee("Hello String"));

    // echo Custom::uppercase("hello");

    return view('welcome');
});
// Route::get('/users', [UserController::class, 'index']);

Route::get('/hello', function () {
    return response()->json(['message' => 'Hello World!']);
});
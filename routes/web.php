<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoPlayController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
$username = "Guest";
if (Auth::check()) {
    $user = Auth::user();
    $username = $user->name;
} //這一段在找使用者是誰
Route::get('/', [VideoPlayController::class, 'index']);
Route::get('/logout/', [VideoPlayController::class, 'logout']);
Route::post('/addlist/', [VideoPlayController::class, 'addlist']);//是表單所以用post
Route::get('/delete/{id}/', [VideoPlayController::class, 'delete']);
Route::get('/showlist/{id}/', [VideoPlayController::class, 'showlist']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    global $username;//加這一段是因為function裡的變數在外面不能通用，所以要加function裡把該變數變成global讓外面也可以用
    return view('dashboard', compact('username'));//compact意指打包
})->name('dashboard');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Users\UsersController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UsersController::class,'register']);
Route::post('login', [UsersController::class,'authenticate']);
Route::resource('programs',ProgramController::class);
Route::resource('subjects',SubjectController::class);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user',[UsersController::class,'getAuthenticatedUser']);
});
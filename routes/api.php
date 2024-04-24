<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkoutUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group([

    'middleware' => 'api',



], function ($router) {
Route::get('/workouts',[WorkoutController::class,'index']);
Route::get('/workout',[WorkoutController::class,'show']);
Route::post('/workout/create',[WorkoutController::class,'store']);
Route::post('/workout/update',[WorkoutController::class,'update']);
Route::post('/workout/destroy',[WorkoutController::class,'destroy']);
});




Route::group([

    'middleware' => 'api',
    'prefix' => 'auth/user',


], function ($router) {

        Route::post('/login',[UserController::class,'login']);
        Route::post('/register',[UserController::class,'register']);
        Route::post('/logout',[UserController::class,'logout']);
        Route::post('/refresh',[UserController::class,'refresh']);
        Route::post('/userProfile',[UserController::class,'userProfile']);


});
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth/doctor'

], function ($router) {

    Route::post('/login',[DoctorController::class,'login']);
    Route::post('/register',[DoctorController::class,'register']);
    Route::post('/logout',[DoctorController::class,'logout']);
    Route::post('/refresh',[DoctorController::class,'refresh']);
    Route::post('/doctorProfile',[DoctorController::class,'doctorProfile']);

});


Route::post('/users/attach', [WorkoutUserController::class,'attach']);
Route::post('/users/detach', [WorkoutUserController::class,'detach']);
Route::post('/users/sync', [WorkoutUserController::class,'sync']);
Route::post('/users/showUserWorkouts', [WorkoutUserController::class,'showUserWorkouts']);

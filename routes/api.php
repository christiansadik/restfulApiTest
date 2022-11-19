<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\TeamController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware'=>'cors', 'prefix' => 'v1'], function(){
    Route::resource('users', UserController::class);

    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [RegisterController::class, 'login']); 
});

Route::group(['middleware'=>'auth:api', 'prefix' => 'v1'], function () {

    /** WITH RESOURCE **/
    Route::resource('teams', TeamController::class);

    /** WITH GROUP **/
    // Route::controller(TeamController::class)->group(function(){
    //     Route::get('/teams', 'index');
    // });

    /** WITH SINGLE ROUTE **/
    // Roue::get('/teams', [TeamController::class, 'index'])
    
});
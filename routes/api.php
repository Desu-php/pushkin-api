<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicationStatusController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContestantController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilesDownloadController;
use App\Http\Controllers\NewsletterController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', fn() => response()->json(['author' => 'Aleksandr Pushkin', 'domain' => 'pushkin', 'contact' => 'contact@pushkin.com', 'api_version' => 'v1']));


Route::group([
	'prefix' => 'auth'
], function ($router) {
	Route::post('login', [AuthController::class, 'login'])->name('login');
	Route::post('logout', [AuthController::class, 'logout']);
	Route::post('refresh', [AuthController::class, 'refresh']);
	Route::get('me', [AuthController::class, 'me']);
});


Route::group([
	'prefix' => 'users',
    'middleware' => ['auth:api','admin']
], function () {
	Route::get('getAll', [UserController::class, 'getAll']);
    Route::post('', [UserController::class, 'store']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
});



Route::group([
	'prefix' => 'applications'
], function () {
    Route::get('', [ApplicationController::class, 'index']);
    Route::get('getAll', [ApplicationController::class, 'getAll']);
	Route::get('/{id}', [ApplicationController::class, 'get']);
    Route::post('', [ApplicationController::class, 'store']);
    Route::put('/{application}', [ApplicationController::class, 'update']);
    Route::put('/status/{application}', [ApplicationController::class, 'updateStatus']);
    Route::put('/user/{application}', [ApplicationController::class, 'updateUser']);
    Route::post('/upload/{application}', [ApplicationController::class, 'upload']);
});

Route::group([
	'prefix' => 'applicationstatuses'
], function () {
	Route::get('getAll', [ApplicationStatusController::class, 'getAll']);
    Route::post('', [ApplicationStatusController::class, 'store']);
    Route::put('/{applicationStatus}', [ApplicationStatusController::class, 'update']);
    Route::delete('/{applicationStatus}', [ApplicationStatusController::class, 'destroy']);
});


Route::group([
	'prefix' => 'regions'
], function () {
	Route::get('', [RegionController::class, 'index']);
	Route::get('getAll', [RegionController::class, 'getAll']);
    Route::post('', [RegionController::class, 'store']);
    Route::put('/{region}', [RegionController::class, 'update']);
    Route::delete('/{region}', [RegionController::class, 'destroy']);
});

Route::group([
	'prefix' => 'cities'
], function () {
	Route::get('', [CityController::class, 'index']);
	Route::get('getAll', [CityController::class, 'getAll']);
	Route::get('/{region}', [CityController::class, 'getByRegion']);
    Route::post('', [CityController::class, 'store']);
    Route::put('/{city}', [CityController::class, 'update']);
    Route::delete('/{city}', [CityController::class, 'destroy']);
});


Route::group([
	'prefix' => 'contests'
], function () {
	Route::get('/protocol/{contestId}', [ContestController::class, 'protocol']);
	Route::get('', [ContestController::class, 'index']);
	Route::get('getAll', [ContestController::class, 'getAll']);
    Route::post('', [ContestController::class, 'store']);
    Route::put('/{contest}', [ContestController::class, 'update']);
    Route::delete('/{contest}', [ContestController::class, 'destroy']);
    Route::get('agegroups/{contest}', [ContestController::class, 'getAgeGroups']);
    Route::get('themes/{ageGroup}', [ContestController::class, 'getThemes']);
    Route::post('agegroups/{contest}', [ContestController::class, 'setAgeGroups']);
    Route::post('themes/{ageGroup}', [ContestController::class, 'setThemes']);
    Route::put('agegroups/{ageGroup}', [ContestController::class, 'editAgeGroups']);
    Route::put('themes/{theme}', [ContestController::class, 'editThemes']);
    Route::delete('agegroups/{ageGroup}', [ContestController::class, 'removeAgeGroups']);
    Route::delete('themes/{theme}', [ContestController::class, 'removeThemes']);
});

Route::group([
	'prefix' => 'contestants'
], function () {
	Route::get('', [ContestantController::class, 'index']);
	Route::get('getAll', [ContestantController::class, 'getAll']);
    Route::post('', [ContestantController::class, 'store']);
    Route::put('/{contestant}', [ContestantController::class, 'update']);
    Route::delete('/{contestant}', [ContestantController::class, 'destroy']);
});

Route::group([
    'prefix' => 'files',
], function () {
    Route::get('/{applicationId}/{fileName}', [FilesDownloadController::class, 'index']);
});

Route::group([
    'prefix' => 'newsletters',
    'middleware' => ['auth:api','admin']
], function () {
    Route::get('/', [NewsletterController::class, 'index']);
    Route::get('getAll', [NewsletterController::class, 'getAll']);
    Route::get('getByStatus/{newsletterStatus}', [NewsletterController::class, 'getByStatus']);
    Route::get('getCountStatus',[NewsletterController::class, 'getCountStatus']);
    Route::post('start',[NewsletterController::class, 'start']);

});



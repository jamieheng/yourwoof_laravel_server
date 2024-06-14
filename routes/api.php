<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\userController;
use App\Http\Controllers\Api\petController;
use App\Http\Controllers\Api\surrenderController;
use App\Http\Controllers\Api\adoptionController;
use App\Http\Controllers\Api\breedsController;
use App\Http\Controllers\Api\categoriesController;
use App\Http\Controllers\Api\trackingController;
use App\Http\Controllers\Api\postController;
use App\Http\Controllers\Api\donationController;
use App\Http\Controllers\Api\tipsController;


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


Route::get('/users', [userController::class, 'index']);
Route::get('/users/{id}', [userController::class, 'getUserById']);
Route::post('/users/register', [userController::class, 'register']);
Route::post('/users', [userController::class, 'login']);
Route::put('/users/update/{id}', [userController::class, 'update']);
Route::delete('/users/{id}', [userController::class, 'destroy']);
Route::put('/users/verified/{id}', [userController::class, 'verified']);
Route::put('/users/admin/{id}', [userController::class, 'as_admin']);


Route::get('/pets', [petController::class, 'index']);
Route::post('/pets', [petController::class, 'store']);
Route::put('/pets/{id}', [petController::class, 'update']);
Route::put('/pets/remove/{id}', [petController::class, 'remove']);
Route::delete('/pets/{id}', [petController::class, 'delete']);

Route::get('/surrenders', [surrenderController::class, 'index']);
Route::post('/surrenders', [surrenderController::class, 'store']);
Route::delete('/surrenders/{id}', [surrenderController::class, 'destroy']);

Route::get('/adoptions', [adoptionController::class, 'index']);
Route::post('/adoptions', [adoptionController::class, 'store']);
Route::delete('/adoptions/{id}', [adoptionController::class, 'destroy']);
Route::put('/adoptions/approved/{id}', [adoptionController::class, 'approveAdoption']);

Route::get('/trackings', [trackingController::class, 'index']);
Route::post('/trackings', [trackingController::class, 'store']);
Route::get('/trackings/{id}', [trackingController::class, 'getTrackingById']);
Route::delete('/trackings/{id}', [trackingController::class, 'destroy']);
Route::put('/trackings/updateWeek1/{id}', [trackingController::class, 'updatePetWeek1']);
Route::put('/trackings/updateWeek2/{id}', [trackingController::class, 'updatePetWeek2']);
Route::put('/trackings/updateWeek3/{id}', [trackingController::class, 'updatePetWeek3']);
Route::put('/trackings/updateWeek4/{id}', [trackingController::class, 'updatePetWeek4']);
Route::put('/trackings/completed/{id}', [trackingController::class, 'completed']);
Route::put('/trackings/reported/{id}', [trackingController::class, 'reported']);


Route::get('/categories', [categoriesController::class, 'index']);
Route::post('/categories', [categoriesController::class, 'store']);
Route::delete('/categories/{id}', [categoriesController::class, 'delete']);
Route::put('/categories/{id}', [categoriesController::class, 'update']);


Route::get('/breeds', [breedsController::class, 'index']);
Route::post('/breeds', [breedsController::class, 'store']);
Route::delete('/breeds/{id}', [breedsController::class, 'delete']);
Route::put('/breeds/{id}', [breedsController::class, 'update']);


//For donation
Route::get('/donations', [donationController::class, 'index']);
Route::post('/donations', [donationController::class, 'store']);
Route::get('/donations/user/{id}', [donationController::class, 'getDonationByUserID']);
Route::get('/donations/category/{id}', [donationController::class, 'getDonationByCateID']);
// Route::put('/donations/{donation_id}', [DonationController::class, 'update']);
Route::delete('/donations/{id}', [DonationController::class, 'destroy']);

//For Tips
Route::get('/tips', [tipsController::class, 'index']);
Route::post('/tips', [tipsController::class, 'store']);
Route::delete('/tips/{id}', [tipsController::class, 'delete']);
Route::put('/tips/{id}', [tipsController::class, 'update']);

// For Posts
Route::get('/posts', [postController::class, 'index']);
Route::post('/posts', [postController::class, 'store']);
Route::put('/posts/{id}', [postController::class, 'update']);
Route::put('/posts/remove/{id}', [postController::class, 'remove']);
Route::put('/posts/adopted/{id}', [postController::class, 'adopted']);
Route::put('/posts/valid/{id}', [postController::class, 'valid']);
Route::put('/posts/unvalid/{id}', [postController::class, 'unvalid']);
Route::put('/posts/approved/{id}', [postController::class, 'approved']);
Route::delete('/posts/{id}', [postController::class, 'destroy']);

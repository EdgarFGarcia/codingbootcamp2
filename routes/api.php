<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * Category API calls REST
 */
Route::post('/createcategory', [ApiController::class, 'createcategory']);
Route::get('/getcategories/{item?}', [ApiController::class, 'getcategories']);
Route::put('/editcategory/{id?}', [ApiController::class, 'editcategory']);
Route::delete('/deletecategory/{id?}', [ApiController::class, 'deletecategory']);

/**
 * Item API calls REST
 */
Route::post('/createitem', [ApiController::class, 'createitem']);
Route::get('/getitems/{item?}', [ApiController::class, 'getitems']);
Route::put('/edititem/{id?}', [ApiController::class, 'edititem']);
Route::delete('/deleteitem/{id?}', [ApiController::class, 'deleteitem']);
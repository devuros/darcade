<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| These routes are all prefixed with /api!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {

    return new UserResource($request->user());

});

Route::apiResource('games', 'GameController');

Route::apiResource('developers', 'DeveloperController');

Route::apiResource('publishers', 'PublisherController');

Route::apiResource('genres', 'GenreController');

Route::apiResource('screenshots', 'ScreenshotController');

Route::apiResource('cart', 'CartController')->only(['index', 'store', 'destroy']);
Route::delete('cart', 'CartController@empty')->name('cart.empty');
Route::post('cart/checkout', 'CartController@checkout')->name('cart.checkout');

Route::apiResource('purchases', 'PurchaseController')->only(['index', 'show']);

Route::apiResource('library', 'LibraryController')->only('index');
Route::get('users/{id}/games', 'LibraryController@showUserGames')->name('user.games');

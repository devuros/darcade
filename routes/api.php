<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

Route::middleware('auth:api')->get('/user', function (Request $request) {

    return new UserResource($request->user());

});

Route::apiResource('games', 'GameController');

Route::apiResource('developers', 'DeveloperController');
Route::get('developers/{id}/games', 'DeveloperController@showDeveloperGames')->name('developer.games');

Route::apiResource('publishers', 'PublisherController');
Route::get('publishers/{id}/games', 'PublisherController@showPublisherGames')->name('publisher.games');

Route::apiResource('genres', 'GenreController');
Route::get('genres/{id}/games', 'GenreController@showGenreGames')->name('genre.games');

Route::apiResource('screenshots', 'ScreenshotController');

Route::apiResource('cart', 'CartController')->only(['index', 'store', 'destroy']);
Route::delete('cart', 'CartController@empty')->name('cart.empty');
Route::post('cart/checkout', 'CartController@checkout')->name('cart.checkout');

Route::apiResource('purchases', 'PurchaseController')->only(['index', 'show']);

Route::apiResource('library', 'LibraryController')->only('index');
Route::get('users/{id}/games', 'LibraryController@showUserGames')->name('user.games');

Route::apiResource('wishes', 'WishController');
Route::get('users/{id}/wishes', 'WishController@showUserWishes')->name('user.wishes');

Route::apiResource('reviews', 'ReviewController');
Route::get('users/{id}/reviews', 'ReviewController@showUserReviews')->name('user.reviews');

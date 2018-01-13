<?php

Route::apiResource('users', 'UserController')->only(['index', 'show', 'destroy']);
Route::get('/user', 'UserController@showCurrentUser');

Route::apiResource('games', 'GameController');
Route::get('genres/{id}/games', 'GameController@showGenreGames')->name('genre.games');

Route::apiResource('developers', 'DeveloperController');
Route::get('developers/{id}/games', 'DeveloperController@showDeveloperGames')->name('developer.games');

Route::apiResource('publishers', 'PublisherController');
Route::get('publishers/{id}/games', 'PublisherController@showPublisherGames')->name('publisher.games');

Route::apiResource('genres', 'GenreController');
Route::get('games/{id}/genres', 'GenreController@showGameGenre')->name('game.genres');

Route::apiResource('screenshots', 'ScreenshotController');

Route::apiResource('cart', 'CartController')->only(['index', 'store', 'destroy']);
Route::delete('cart', 'CartController@empty')->name('cart.empty');
Route::post('cart/checkout', 'CartController@checkout')->name('cart.checkout');

Route::apiResource('purchases', 'PurchaseController')->only(['index', 'show']);

Route::apiResource('library', 'LibraryController')->only('store');
Route::get('library', 'LibraryController@showCurrentUserLibrary');
Route::get('users/{id}/library', 'LibraryController@showUserLibrary');

Route::apiResource('wishes', 'WishController')->except('index');
Route::get('wishes', 'WishController@showCurrentUserWishes');
Route::get('users/{id}/wishes', 'WishController@showUserWishes');

Route::apiResource('reviews', 'ReviewController')->except('index');
Route::get('reviews', 'ReviewController@showCurrentUserReviews');
Route::get('users/{id}/reviews', 'ReviewController@showUserReviews');

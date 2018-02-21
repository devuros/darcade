<?php

Route::apiResource('users', 'UserController')->only(['index', 'show', 'store', 'destroy']);
Route::get('user', 'UserController@showCurrentUser');
Route::post('auth', 'UserController@authenticate');

Route::apiResource('games', 'GameController');
Route::get('genres/{id}/games', 'GameController@showGenreGames')->name('genre.games');
Route::get('developers/{id}/games', 'GameController@showDeveloperGames')->name('developer.games');
Route::get('publishers/{id}/games', 'GameController@showPublisherGames')->name('publisher.games');
Route::get('screenshots/{id}/game', 'GameController@showScreenshotGame')->name('screenshot.game');
Route::put('games/{id}/sale', 'GameController@updateGameIsOnSale');
Route::post('game-genre', 'GameController@attachGenre');
Route::get('games/under/10', 'GameController@showGamesUT');
Route::get('games/under/25', 'GameController@showGamesUTF');

Route::apiResource('developers', 'DeveloperController');
Route::get('games/{id}/developer', 'DeveloperController@showGameDeveloper')->name('game.developer');

Route::apiResource('publishers', 'PublisherController');
Route::get('games/{id}/publisher', 'PublisherController@showGamePublisher')->name('game.publisher');

Route::apiResource('genres', 'GenreController');
Route::get('games/{id}/genres', 'GenreController@showGameGenres')->name('game.genres');

Route::apiResource('screenshots', 'ScreenshotController')->only(['index', 'store', 'show', 'destroy']);
Route::get('games/{id}/screenshots', 'ScreenshotController@showGameScreenshots')->name('game.screenshots');
Route::get('image/{path}', 'ScreenshotController@image');

Route::apiResource('cart', 'CartController')->only(['index', 'store', 'destroy']);
Route::delete('cart', 'CartController@empty')->name('cart.empty');
Route::post('cart/checkout', 'CartController@checkout')->name('cart.checkout');

Route::apiResource('purchases', 'PurchaseController')->only(['index', 'show']);

Route::apiResource('library', 'LibraryController')->only(['store']);
Route::get('library', 'LibraryController@showCurrentUserLibrary');
Route::get('users/{id}/library', 'LibraryController@showUserLibrary');

Route::apiResource('wishes', 'WishController')->only(['store', 'destroy']);
Route::get('wishes', 'WishController@showCurrentUserWishes');
Route::get('users/{id}/wishes', 'WishController@showUserWishes');

Route::apiResource('reviews', 'ReviewController')->only(['store', 'show', 'update', 'destroy']);
Route::get('reviews', 'ReviewController@showCurrentUserReviews');
Route::get('users/{id}/reviews', 'ReviewController@showUserReviews');
Route::get('games/{id}/reviews', 'ReviewController@showGameReviews')->name('game.reviews');
Route::get('games/{id}/statistics', 'ReviewController@showOverallStatistics');

Route::apiResource('roles', 'RoleController')->only(['index']);
Route::get('users/{id}/roles', 'RoleController@showUserRoles');
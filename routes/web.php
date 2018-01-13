<?php

Route::view('/', 'welcome')->name('root');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

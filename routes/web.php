<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::get('/profile', 'UserController@profile');
    Route::patch('/profile', 'UserController@update');
    Route::get('/library', 'UserController@library');
    Route::get('/my-books', 'UserController@myBooks');
    Route::get('/books/borrow/{book}', 'UserController@borrow');
    Route::post('/books/borrow/{book}', 'UserController@borrowBook');
    Route::get('/books/details/{book}', 'UserController@detailsOfBorrowing');
    Route::delete('/books/details/{reservation}', 'UserController@destroy');
});

Route::group(['middleware' => ['librarian']], function(){
    Route::get('/librarian', 'LibrarianController@index');
    Route::get('/librarian-profile', 'LibrarianController@profile');
    Route::patch('/librarian-profile', 'LibrarianController@update');
    Route::get('/books/create', 'BookController@create');
    Route::post('/books/', 'BookController@store');
    Route::get('/books/', 'BookController@allBooks');
    Route::get('/books/{book}/edit','BookController@edit');
    Route::get('/books/{book}/show/','BookController@show');
    Route::patch('/books/{book}','BookController@update');
    Route::delete('/books/{book}','BookController@destroy');
});

Route::get('/home', 'HomeController@index')->name('home');

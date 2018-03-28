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

Route::middleware(['logging'])->group(function () { // Middleware for logging activity on every request

    //Tweet routes
        Route::get('/home', 'TweetsController@index')->name('home'); //Index page with all tweets
        Route::get('delete/{tweet}', 'TweetsController@delete'); //Delete a tweet
        Route::post('/tweets', 'TweetsController@store'); // Add a new tweet to the database

    //Comment routes
        Route::get('/comments', 'TweetsController@showTweetComments'); // Shows comments for the specified tweet
        Route::post('/comments/{tweet}', 'CommentsController@store'); // Adds comment for specified tweet

    //Profile routes
        Route::get('/user/{user?}', 'ProfileController@showUser'); //Shows user profile
        Route::post('/user', 'ProfileController@editPicture'); //Edit user picture

    //Following routes
        Route::get('/follow/{id}', 'ProfileController@follow');
        Route::get('/unfollow/{id}', 'ProfileController@unfollow');


    //Auth routes
        Route::get('/', 'AuthController@index')->name('login'); //Shows login and register page
        Route::post('/welcome/register', 'AuthController@register'); //Registers new user
        Route::post('/welcome/login', 'AuthController@login'); //Logs in user
        Route::get('logout', 'AuthController@destroy'); //Destroys the user session

    //Vote routes
        Route::get('vote/{id}/value/{sum}','TweetsController@vote');

        Route::get('/about', 'AboutController@index');
});


//ADMIN ROUTES
Route::namespace('Admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::middleware(['AdminMiddleware'])->group(function () {

            //Users
            Route::get('/users/{id?}', 'UsersController@index');
            Route::get('/users/{id}/delete', 'UsersController@destroy');
            Route::post('/users/{user}/update', 'UsersController@update');
            Route::post('/users/insert', 'UsersController@store');

            //Tweets
            Route::get('/tweets/{id?}', 'TweetsController@index');
            Route::get('/tweets/{id}/delete', 'TweetsController@destroy');
            Route::post('/tweets/{id}/update', 'TweetsController@update');
            Route::post('/tweets/insert', 'TweetsController@store');

            //Comments
            Route::get('/comments/{id?}', 'CommentsController@index');
            Route::get('/comments/{id}/delete', 'CommentsController@destroy');
            Route::post('/comments/{id}/update', 'CommentsController@update');
            Route::post('/comments/insert', 'CommentsController@store');

            //Links
            Route::get('/links/{id?}', 'LinksController@index');
            Route::get('/links/{id}/delete', 'LinksController@destroy');
            Route::post('/links/insert', 'LinksController@store');
            Route::post('/links/{id}/update', 'LinksController@update');


            //Ratings
            Route::get('/ratings/{id?}' , 'RatingsController@index');
            Route::post('/ratings/insert', 'RatingsController@store');
            Route::get('/ratings/{id}/delete', 'RatingsController@destroy');
            Route::post('/ratings/{id}/update', 'RatingsController@update');
        });
    });
});

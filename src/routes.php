<?php

use webvolant\abposts\Console;
use webvolant\abadmin\Http\Middleware;
use Illuminate\Support\Facades\View;

use webvolant\abposts\Models\Post;


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    \Route::get('/getPosts', function()
    {
        return Post::where('status','!=',0)->orderBy('id','desc')->get();
    });

    \Route::get('jobs', array('as'=>'jobs','uses'=>'webvolant\abposts\Http\Controllers\FrontPostController@jobs'));

    \Route::post('jobs/{link}', array('as'=>'jobs/detail','uses'=>'webvolant\abposts\Http\Controllers\FrontPostController@job_detail'))->where('link', '[A-Za-z-0-9]+');
});


//группа роутов админа
    \Route::group(['prefix'=>'admin','middleware' => 'webvolant\abadmin\Http\Middleware\CheckRoleManager'], function() {

//Posts
        \Route::get('post/index', array('as'=>'post/index','uses'=>'webvolant\abposts\Http\Controllers\PostController@index'));
        \Route::get('post/add', array('as'=>'post/add','uses'=>'webvolant\abposts\Http\Controllers\PostController@add'));
        \Route::post('post/add', array('as'=>'post/add','uses'=>'webvolant\abposts\Http\Controllers\PostController@add'));

        \Route::get('post/edit/{link}', array('as'=>'post/edit','uses'=>'webvolant\abposts\Http\Controllers\PostController@edit'))->where('link', '[A-Za-z-0-9]+');
        \Route::post('post/edit/{link}', array('as'=>'post/edit','uses'=>'webvolant\abposts\Http\Controllers\PostController@edit'))->where('link', '[A-Za-z-0-9]+');

        \Route::get('post/delete/{link}', array('as'=>'post/delete','uses'=>'webvolant\abposts\Http\Controllers\PostController@delete'))->where('link', '[A-Za-z-0-9]+');

    });





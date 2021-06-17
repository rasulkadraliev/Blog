<?php

use Illuminate\Support\Facades\Route;

/**
 * Show Notes
 */
Route::get('/', 'Blog\BlogController@index')->name('blog.index');

/**
 * Create a blog note
 */
Route::post('/index', 'Blog\BlogController@add_note')->name('blog.add_note');

/**
 * Delete a blog note
 */
Route::delete('/note/{note}', 'Blog\BlogController@delete_note')->name('blog.delete_note');

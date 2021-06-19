<?php

use Illuminate\Support\Facades\Route;

/**
 * Admin panel
 */
Route::get('/', 'Blog\BlogController@index')->name('blog.index');

/**
 * Create a blog note
 */
Route::post('/index', 'Blog\BlogController@add_note')->name('blog.add_note');

/**
 * Read a blog note
 */
Route::get('/notes/{note}', 'Blog\BlogController@read_note')->name('blog.read_note');

/**
 * Delete a blog note
 */
Route::delete('/delete/{note}', 'Blog\BlogController@delete_note')->name('blog.delete_note');

/**
 * Blog notes list
 */
Route::get('/notes-list', 'Blog\BlogController@notes_list')->name('blog.notes_list');

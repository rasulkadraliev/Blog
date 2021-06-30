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
 * Save edited blog note
 */
Route::post('/index/{note}', 'Blog\BlogController@add_note')->name('blog.add_note');

/**
 * Read a blog note
 */
Route::get('/note/{note}', 'Blog\BlogController@read_note')->name('blog.read_note');

/**
 * Edit a blog note
 */
Route::get('/note/{note}/edit', 'Blog\BlogController@edit_note')->name('blog.edit_note');

/**
 * Save a blog note
 */
//Route::post('/note/{note}/edit', 'Blog\BlogController@add_note')->name('blog.save_note');

/**
 * Delete a blog note
 */
Route::delete('/delete/{note}', 'Blog\BlogController@delete_note')->name('blog.delete_note');

/**
 * Blog notes list
 */
Route::get('/notes-list', 'Blog\BlogController@notes_list')->name('blog.notes_list');

<?php

use App\Blog;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


/**
 * Show Task Dashboard
 */
Route::get('/', function () {
    $notes = Blog::orderBy('created_at', 'asc')->get();
        return view('hello', [
            'notes' => $notes
        ]);
});

/**
 * Create a blog note
 */
Route::post('/', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'header' => 'required|max:50',
        'text' => 'required',
        'author' => 'required|max:50',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $blog = new Blog;
    $blog->header = $request->header;
    $blog->text = $request->text;
    $blog->author = $request->author;
    $blog->published = $request->get('published') ?? false;
    $blog->date_published = $request->date_published;
    $blog->save();

    return redirect('/');});

/**
 * Удалить задачу
 */
Route::delete('/note/{note}', function (Blog $task) {
    //
});

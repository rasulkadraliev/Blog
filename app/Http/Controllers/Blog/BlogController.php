<?php

namespace App\Http\Controllers\Blog;

use App\Blog;
use App\Http\Controllers\Controller;

/**
 * Class ProjectUserController
 * @package App\Http\Controllers\Project
 */
class BlogController extends Controller {

    /**
     * Список проектов доступных пользователю
     *
     * @return string
     */
    public function index() {

        $notes = Blog::orderBy('created_at', 'asc')->get();
        return view('hello', [
            'notes' => $notes
        ]);


    }
}

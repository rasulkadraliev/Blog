<?php

namespace App\Http\Controllers\Blog;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class BlogController
 * @package App\Http\Controllers\Blog
 */
class BlogController extends Controller {

    /**
     * Index page
     *
     * @return string
     */
    public function index() {

        $notes = Blog::orderBy('created_at', 'asc')->get();
        return view('index', [
            'notes' => $notes
        ]);
    }

    public function add_note(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:35',
            'text' => 'required|max:255',
            'author' => 'required|max:35',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

            $blog = new Blog;
            $blog->title = $request->title;
            $blog->text = $request->text;
            $blog->author = $request->author;
            $blog->published = $request->get('published') ?? true;
            $blog->date_published = date('Y-m-d H:i:s');
            $blog->save();

            return redirect('/');
    }

    public function delete_note(Blog $note) {
        $note->delete();

        return redirect('/');
    }
}

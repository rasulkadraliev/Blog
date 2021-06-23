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

    /**
     * Add note: published or not
     *
     * @return string
     */
    public function add_note(Request $request) {

//        Validation of text limits
        $result = $this->validator_func($request);
        if ($result->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($result);
        }

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->text = $request->text;
        $blog->author = $request->author;
        switch ($request->published) {
            case "on":
                $blog->published = 'Yes';
                $blog->date_published = date('Y-m-d H:i:s');
                break;
            default:
                $blog->published = 'No';
        }

        $blog->save();

        return redirect('/');
    }

    public function validator_func(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:35',
            'text' => 'required|max:255',
            'author' => 'required|max:35',
        ]);

        return $validator;
    }

    /**
     * Save edited note
     *
     * @return string
     */

    public function save_note(Request $request, Blog $note) {

//        Validation of text limits
        $result = $this->validator_func($request);
        if ($result->fails()) {
            return redirect('/note/'. $note->id .'/edit')
                ->withInput()
                ->withErrors($result);
        }

//        Assigning new values to a note
        $note->title = $request->title;
        $note->author = $request->author;
        $note->text = $request->text;
        switch ($request->published) {
            case "on":
                $note->published = 'Yes';
                $note->date_published = date('Y-m-d H:i:s');
                break;
            default:
                $note->published = 'No';
        }
        $note->save();

        return redirect('/');
    }

    /**
     * Read note
     *
     * @return string
     */

    public function read_note(Blog $note) {
        return view('single_note', [
            'note' => $note,
        ]);
    }

    /**
     * Edit note
     *
     * @return string
     */

    public function edit_note(Blog $note) {

        return view('edit', [
            'note' => $note,
        ]);
    }

    /**
     * Delete note
     *
     * @return string
     */

    public function delete_note(Blog $note) {

        $note->delete();

        return redirect('/');
    }

    /**
     * Published notes list
     *
     * @return string
     */
    public function notes_list() {

        $notes = Blog::where('published', 'Yes')->get();

        return view('notes', ['notes' => $notes]);
    }
}

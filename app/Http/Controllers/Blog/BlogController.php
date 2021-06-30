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
     * @return string|mixed
     */
    public function index() {

        $notes = Blog::orderBy('created_at', 'asc')->get();
        return view('index', [
            'notes' => $notes
        ]);
    }

    /**
     * Add new or Save edited note
     *
     * @return string|mixed
     */
    public function add_note(Request $request, Blog $note) {

        // Validation of text conditions
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
        // End of validation of text conditions

        // Checking if a note does not already exist (and in this case creating a new note)
        if (empty($note))
            $note = new Blog;

        $note->title = $request->title;
        $note->text = $request->text;
        $note->author = $request->author;
        $note->published = 'No';
        if ($request->published == "on") {
            $note->published = 'Yes';
            $note->date_published = date('Y-m-d H:i:s');
        }

        $note->save();

        return redirect('/');
    }

    /**
     * Read note
     *
     * @return string|mixed
     */

    public function read_note(Blog $note) {
        return view('single_note', [
            'note' => $note,
        ]);
    }

    /**
     * Edit note
     *
     * @return string|mixed
     */

    public function edit_note(Blog $note) {

        return view('edit', [
            'note' => $note,
        ]);
    }

    /**
     * Delete note
     *
     * @return string|mixed
     */

    public function delete_note(Blog $note) {

        $note->delete();

        return redirect('/');
    }

    /**
     * Published notes list
     *
     * @return string|mixed
     */
    public function notes_list() {

        $notes = Blog::where('published', 'Yes')->get();

        return view('notes', ['notes' => $notes]);
    }
}

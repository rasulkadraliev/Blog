<?php

namespace App\Http\Controllers\Blog;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
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
//        dd($notes);
        return view('index', [
            'notes' => $notes
        ]);
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
     * Add note: published or not
     *
     * @return string
     */
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
            switch ($request->published) {
                case "on":
                    $blog->published = 'Yes';
                    break;
                default:
                    $blog->published = 'No';
            }
            $blog->date_published = date('Y-m-d H:i:s');
            $blog->save();

            return redirect('/');
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

        $notes = Blog::orderBy('created_at', 'asc')->get();
        $is_published = 'No';
        foreach ($notes as $note)
            if ($note->published == 'Yes') {
                $is_published = 'Yes';
                break;
            }

        return view('notes', [
            'notes' => $notes,
            'is_published' => $is_published
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the admin panel.
     *
     * @return Response
     */
    public function __invoke()
    {
        return view('admin', [
            'tags' => Tag::all(),
            'posts' => Post::all(),
        ]);
    }
}

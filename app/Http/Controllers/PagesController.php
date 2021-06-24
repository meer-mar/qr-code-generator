<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Load main site index page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Welcome to my App";
        return view('pages.index')->with('title', $title);
    }
}

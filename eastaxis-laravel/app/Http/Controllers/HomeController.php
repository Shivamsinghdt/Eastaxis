<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\Expert;
use App\Models\Program;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::published()->latest('published_at')->take(3)->get();
        $programs = Program::published()->get();
        $events = Event::published()->upcoming()->take(3)->get();
        $experts = Expert::published()->take(8)->get();

        return view('home', compact('articles', 'programs', 'events', 'experts'));
    }
}

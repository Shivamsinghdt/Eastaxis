<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Event;
use App\Models\Expert;
use App\Models\Program;
use App\Models\Subscriber;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'events' => Event::count(),
            'programs' => Program::count(),
            'experts' => Expert::count(),
            'subscribers' => Subscriber::count(),
        ];

        $recentArticles = Article::latest()->take(5)->get();
        $recentSubscribers = Subscriber::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentArticles', 'recentSubscribers'));
    }
}

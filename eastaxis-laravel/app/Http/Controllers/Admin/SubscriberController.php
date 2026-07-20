<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->paginate(30);

        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return back()->with('status', 'Subscriber removed.');
    }

    public function export(): StreamedResponse
    {
        $subscribers = Subscriber::orderBy('created_at')->get();

        return response()->streamDownload(function () use ($subscribers) {
            echo "email,subscribed_at\n";
            foreach ($subscribers as $subscriber) {
                echo $subscriber->email.','.$subscriber->created_at."\n";
            }
        }, 'newsletter-subscribers.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }
}

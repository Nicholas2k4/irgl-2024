<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\SemiState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function index()
    {
        $curNews = SemiState::first()->news();
        return view('admin.news', [
            'current_news' => $curNews,
            'title' => 'News',
        ]);
    }

    public function skipNews()
    {
        try {
            $curState = SemiState::first();
            $curNews = SemiState::first()->news();
            $curState->current_news_slug = $curNews->next_slug;
            $curState->save();
            Log::channel('daily')->info(Session::get('name') . ' updated the news from ' . $curNews->slug . ' to ' . $curNews->next_slug);
            return redirect()->route('admin.news')->with('success', 'News skipped!');
        } catch (Exception $e) {
            return redirect()->route('admin.news')->with('error', 'Failed to skip news!');
        }
    }
}

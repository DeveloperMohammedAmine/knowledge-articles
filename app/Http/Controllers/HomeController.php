<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $most_writers = User::with('profile')->withCount('articles')->orderBy('articles_count', 'desc')->limit(4)->get();
        return view('home', compact("most_writers"));
    }

    public function contact() {
        return view('contact');
    }



}

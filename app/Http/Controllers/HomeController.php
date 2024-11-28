<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        return view('home');
    }

    public function contact() {
        return view('contact');
    }

    static public function getMostWriters() {

        $most_writers = User::withCount('articles') -> orderBy('articles_count', 'desc') -> limit(4) -> get();
        return $most_writers;
    }



}

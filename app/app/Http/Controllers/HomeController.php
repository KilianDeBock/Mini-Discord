<?php

namespace App\Http\Controllers;

use App\Models\Guild;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        [$guilds, $user] = Guild::getGuilds();
        // Test active state
        if ($guilds == null) {
            return view('home.home');
        }
        return view('home.home', [
            'user' => $user,
            'guilds' => $guilds,
        ]);
    }
}

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
        if ($guilds->count() < 1) {
            return view('home.home', [
                'user' => $user,
                'guilds' => $guilds,
            ]);
        }
        return redirect('/guild/' . $guilds->first()->id);
//        return view('home.home', [
//            'user' => $user,
//            'guilds' => $guilds,
//        ]);
    }
}

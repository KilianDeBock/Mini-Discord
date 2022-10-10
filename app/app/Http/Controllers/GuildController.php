<?php

namespace App\Http\Controllers;


use App\Models\Guild;

class GuildController extends Controller
{
    public function index($id)
    {
        $guild = Guild::find($id);
        if ($guild == null) {
            return view('home.home');
        }
        return view('guild.guild', [
            'guild_id' => $id,
            'guild' => $guild,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\UserSignedUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Cache;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home()
    {
        if (auth()->check()){
            event(new UserSignedUp(auth()->user()));
        }

        return view('welcome');
    }
}

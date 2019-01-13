<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class UserApiController extends Controller
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
     * @return User
     */
    public function getUser() : User
    {
       return auth()->user();
    }

    /**
     * @return Collection
     */
    public function getUsers() : Collection
    {
        return User::where('id', '!=', auth()->user()->id)->get();
    }
}

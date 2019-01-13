<?php

namespace App\Http\Controllers;

use App\Events\UserPushMessage;
use App\Http\Requests\UserMessagePushRequest;
use App\Models\User;

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
        return view('pages.home');
    }

    /**
     * @param UserMessagePushRequest $request
     * @return string
     */
    public function push(UserMessagePushRequest $request): string
    {
        $user = User::where('id', $request->input('user_id'))->firstOrFail();
        $message = $request->input('message');
        event(new UserPushMessage(auth()->user(), $user, $message));

        return response()->json('Ok', 200);
    }
}

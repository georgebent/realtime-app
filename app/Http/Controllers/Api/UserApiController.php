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
//        $this->middleware('auth');
    }

    /**
     * @SWG\Get(
     *     path="/api/user",
     *     summary="Get user",
     *     tags={"Get User"},
     *     @SWG\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=false,
     *          type="integer",
     *          in="query",
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function getUser()
    {
        $user = auth()->user();
        return $user ? $user : ['message' => 'not found'];
    }

    /**
     * @return Collection
     */
    public function getUsers() : Collection
    {
        return User::where('id', '!=', auth()->user()->id)->get();
    }
}

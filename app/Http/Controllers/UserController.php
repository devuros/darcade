<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Resources\UserResource;

use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api');

    }

    /**
     * Get the authenticated user
     */
    public function showCurrentUser()
    {

        return new UserResource(Auth::user());

    }

    /**
     * Get all users
     */
    public function index()
    {

        if (Auth::user()->cant('index', 'App\User'))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        $users = User::all();

        return UserResource::collection($users);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Get one user
     */
    public function show($id)
    {

        if (Auth::user()->cant('show', 'App\User'))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        $user = User::find($id);

        if (empty($user))
        {

            return $this->respondNotFound('Sorry, the requested user was not found');

        }

        return new UserResource($user);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Delete a user
     */
    public function destroy($id)
    {

        $user = User::find($id);

        if (empty($user))
        {

            return $this->respondNotFound('Sorry, the requested user was not found');

        }

        if (Auth::user()->cant('delete', $user))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        if ($user->delete()) {

            return $this->respondSuccess('User successfully deleted');

        }

        return $this->respondInternalError('Something went wrong, action could not be completed');

    }
}

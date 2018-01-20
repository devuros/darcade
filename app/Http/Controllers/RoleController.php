<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;

use Illuminate\Support\Facades\Auth;

use App\Http\Resources\RoleResource;

class RoleController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api');

    }

    /**
     * Display a listing of roles
     */
    public function index()
    {

        if (Auth::user()->cant('index', 'App\Role'))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        $roles = Role::all();

        if ($roles->isEmpty())
        {

            return $this->respondNotFound('Sorry, there are no roles');

        }

        return RoleResource::collection($roles);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // route disabled
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // route disabled
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
        // route disabled
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // route disabled
    }

    /**
     * Get the requested user's roles
     */
    public function showUserRoles($id)
    {

        if (Auth::user()->cant('showUserRoles', 'App\Role'))
        {

            return $this->respondForbidden('You dont have the permissions');

        }

        $user = User::find($id);

        if (empty($user))
        {

            return $this->respondNotFound('Sorry, the requested user was not found');

        }

        $roles = $user->roles;

        if ($roles->isEmpty())
        {

            return $this->respondNotFound('Sorry, there are no roles');

        }

        return RoleResource::collection($roles);

    }

}

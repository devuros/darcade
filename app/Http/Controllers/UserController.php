<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\User;
use App\Http\Resources\UserResource;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\StoreUser;

class UserController extends ApiController
{

    public function __construct()
    {

        $this->middleware('auth:api')->except(['store', 'authenticate']);

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
     * Store a newly created user
     */
    public function store(StoreUser $request)
    {

        \DB::transaction(function () use ($request) {

            $user = new User;

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);

            $user->save();

            $timestamp = \Carbon\Carbon::now();

            $user->roles()->attach(1, ['created_at'=> $timestamp, 'updated_at'=> $timestamp]);

        }, 2);

        return $this->respondCreated('User successfully created');

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
        // route disabled
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

        \DB::beginTransaction();

        try
        {

            $user->roles()->detach();
            $user->delete();

            \DB::commit();

            return $this->respondSuccess('User successfully deleted');

        }
        catch (\Throwable $e)
        {

            \DB::rollback();

            return $this->respondInternalError('Something went wrong, action could not be completed');

        }

    }

    /**
     * Validate user's credentials
     */
    public function authenticate(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');

        $user = \DB::table('users')
            ->where('email', '=', $email)
            ->first();

        if (Hash::check($password, $user->password)) {

            $user_model = User::find($user->id);

            $personal_access_token = $user_model->createToken('name')->accessToken;

            return $this->respondCustom([

                'token'=> $personal_access_token,
                'user_id'=> $user->id,
                'user_name'=> $user->name

            ]);

        }
        else {

            return $this->respondCustom([

                'login'=> 'Credentials missmatch, check your input'

            ]);

        }

    }

}
